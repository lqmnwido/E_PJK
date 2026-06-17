#!/usr/bin/env python3
"""GitHub repo health check: sync, cleanliness, dependency drift."""

import subprocess
import json
import os
import sys
from datetime import datetime

REPO = os.environ.get("REPO_PATH", "D:/Projects/E_PJK")
BRANCH = os.environ.get("REPO_BRANCH", "main")


def run(cmd, cwd=REPO):
    try:
        p = subprocess.run(cmd, shell=True, cwd=cwd, capture_output=True, text=True, timeout=120)
        return p.stdout.strip(), p.stderr.strip(), p.returncode
    except Exception as e:
        return "", str(e), 1


def check_git_sync():
    out, err, rc = run("git rev-list --left-right --count main...origin/main")
    if rc != 0:
        return None, f"git rev-list failed: {err}"
    parts = out.split("\t")
    if len(parts) != 2:
        return None, f"unexpected format: {out}"
    behind, ahead = parts
    return {"behind": int(behind), "ahead": int(ahead)}, None


def check_status():
    out, _, rc = run("git status -sb")
    if rc != 0:
        return None, f"git status failed"
    lines = out.splitlines()
    # Skip first line like ## branch...origin/branch
    changes = []
    for line in lines[1:]:
        changes.append(line)
    return changes, None


def check_composer():
    out, _, rc = run("composer outdated --direct 2>/dev/null || composer show -lo 2>/dev/null")
    if rc != 0 or not out:
        return None, "composer check skipped/failed"
    lines = [l for l in out.splitlines() if l.strip()]
    return lines, None


def check_npm():
    out, _, rc = run("npm outdated --json 2>/dev/null || pnpm outdated --json 2>/dev/null || yarn outdated --json 2>/dev/null")
    if rc != 0 or not out:
        return None, "npm check skipped/failed"
    try:
        data = json.loads(out)
        outdated = []
        for pkg, info in data.items():
            if isinstance(info, dict):
                outdated.append(f"{pkg} {info.get('current')} -> {info.get('latest') or info.get('wanted')}")
        return outdated, None
    except Exception:
        return None, "npm parse failed"


def main():
    ts = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
    report = [f"[{ts}] Repository health: {REPO}\n"]

    # 1. git sync
    sync, sync_err = check_git_sync()
    if sync_err:
        report.append(f"⚠️  Git sync check failed: {sync_err}")
    elif sync["behind"] == 0 and sync["ahead"] == 0:
        report.append("✅ Commits: in sync with origin/" + BRANCH)
    else:
        report.append(f"⚠️  Commits: {sync['behind']} behind, {sync['ahead']} ahead")

    # 2. working tree
    status, status_err = check_status()
    if status_err:
        report.append(f"⚠️  Git status failed: {status_err}")
    elif not status:
        report.append("✅ Working tree: clean")
    else:
        report.append(f"⚠️  Working tree has {len(status)} change(s):")
        for s in status[:5]:
            report.append(f"   {s}")
        if len(status) > 5:
            report.append(f"   ...and {len(status)-5} more")

    # 3. composer
    outdated_composer, comp_err = check_composer()
    if comp_err:
        report.append(f"ℹ️  Composer: {comp_err}")
    elif outdated_composer:
        report.append(f"ℹ️  Outdated Composer packages ({len(outdated_composer)}):")
        for line in outdated_composer[:5]:
            report.append(f"   {line}")

    # 4. npm
    outdated_npm, npm_err = check_npm()
    if npm_err:
        report.append(f"ℹ️  Node packages: {npm_err}")
    elif outdated_npm:
        report.append(f"ℹ️  Outdated npm packages ({len(outdated_npm)}):")
        for line in outdated_npm[:5]:
            report.append(f"   {line}")

    # Summary
    issues = sum(1 for l in report if l.startswith("⚠️"))
    ok = sum(1 for l in report if l.startswith("✅"))
    if issues == 0:
        report.append("\n✅ Overall: repo is healthy and up to date")
    else:
        report.append(f"\n⚠️  Overall: {issues} issue(s) detected")

    print("\n".join(report))


if __name__ == "__main__":
    main()
