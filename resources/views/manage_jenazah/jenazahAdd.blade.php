<title>EPJK</title>
<x-app-layout>
    <br />
    <div class="container text-center">
        <h1 class="text-4xl">MANAGE JENAZAH</h1>
        <br />
        {{-- {{dd($kKematian)}} --}}
        <div class="container mx-auto px-4 bg-gray-200 rounded-3xl py-5 shadow-lg">
            <form method="POST" action="{{ route('store_jenazah') }}" enctype="multipart/form-data">
                @csrf

                <div class="step-one" data-step="1">
                    <h3 class="text-lg font-bold mb-4 text-left">A. MAKLUMAT JENAZAH</h3>

                    <!--Hidden Input-->
                    <input type="hidden" value="{{ $user->userID }}" name="uid">

                    <!-- Flex row for input and label side by side -->
                    <div class="mb-4 flex items-center justify-center gap-4 ml-8">
                        <label for="no_kad_pengenalan" class="font-semibold text-left w-40">No. Kad Pengenalan *</label>
                        <x-input id="no_kad_pengenalan" class="form-control w-96" type="text" name="jenIC"
                            placeholder="No. Kad Pengenalan" value="" required autofocus />
                    </div>

                    <div class="mb-4 flex items-center justify-center gap-4 ml-8">
                        <label for="nama" class="font-semibold text-left w-40">Nama *</label>
                        <x-input id="nama" class="form-control w-96" type="text" name="jenName"
                            placeholder="Nama" value="" required />
                    </div>

                    <div class="mb-4 flex items-center justify-left gap-4 ml-8">
                        <label for="nama" class="font-semibold text-left w-40">Jantina *</label>
                        <label style="padding-right:30px; margin-left:-20px">
                            <input type="radio" name="jenGender" value="male" id="male"> Lelaki
                        </label>
                        <label>
                            <input type="radio" name="jenGender" value="female" id="female"> Perempuan
                        </label>
                    </div>

                    <div class="mb-4 flex items-center justify-center gap-4 ml-8">
                        <label for="no_telefon" class="font-semibold text-left w-40">Tarikh Lahir *</label>
                        <x-input id="no_telefon" class="form-control w-96" type="date" name="jenDOB"
                            placeholder="No. Telefon" value="" required />
                    </div>

                    <div class="mb-4 flex items-left justify-left gap-4 ml-8">
                        <label for="nama" class="font-semibold text-left w-40">Bangsa *</label>
                        <select class="mt-1"
                            style="width:100%; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"
                            name="jenBangsa" :value="old('nationality')" required>
                            <option value="">Bangsa</option>
                            <option value="Malay">Melayu</option>
                            <option value="Chinese">Cina</option>
                            <option value="Indian">India</option>
                        </select>
                    </div>

                    <div class="mb-4 flex items-left justify-left gap-4 ml-8">
                        <label for="nama" class="font-semibold text-left w-40">Warganegara *</label>
                        <select class="mt-1"
                            style="width:100%; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;"
                            name="jenWarga" :value="old('nationality')" required>
                            <option value="">Warganegara</option>
                            <option value="Malay">Bumiputera</option>
                            <option value="Chinese">Cina</option>
                            <option value="Indian">India</option>
                        </select>
                    </div>

                    <div class="mb-4 flex items-center justify-center gap-4 ml-8">
                        <label for="nama" class="font-semibold text-left w-40">Tarikh Meninggal *</label>
                        <x-input id="nama" class="form-control w-96" type="date" name="deathDate"
                            placeholder="Nama" value="" required />
                    </div>

                    <div class="mb-4 flex items-center justify-center gap-4 ml-8">
                        <label for="nama" class="font-semibold text-left w-40">Lampiran (Permit)</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="file_input" type="file" name="permit">
                    </div>
                </div>

                <div class="step-two" data-step="2" style="display: none;">
                    <h3 class="text-lg font-bold mb-4 text-left">B. MAKLUMAT WARIS</h3>

                    <!-- Flex row for input and label side by side -->
                    <div class="mb-4 flex items-center justify-center gap-4 ml-8">
                        <label for="no_kad_pengenalan" class="font-semibold text-left w-40">No. Kad Pengenalan *</label>
                        <x-input id="no_kad_pengenalan" class="form-control w-96" type="text" name="noIC"
                            placeholder="No. Kad Pengenalan" value="{{ $profile->noIC }}" required autofocus />
                    </div>

                    <div class="mb-4 flex items-center justify-center gap-4 ml-8">
                        <label for="nama" class="font-semibold text-left w-40">Nama *</label>
                        <x-input id="nama" class="form-control w-96" type="text" name="name"
                            placeholder="Nama" value="{{ $user->name }}" required />

                            <input type="hidden" name="email" value="{{ $user->email }}">
                    </div>

                    <div class="mb-4 flex items-center justify-center gap-4 ml-8">
                        <label for="no_telefon" class="font-semibold text-left w-40">Tarikh Lahir *</label>
                        <x-input id="no_telefon" class="form-control w-96" type="date" name="DOB"
                            placeholder="DOB" value="{{ $profile->DOB }}" required />
                    </div>

                    <div class="mb-4 flex items-center justify-center gap-4 ml-8">
                        <label for="nama" class="font-semibold text-left w-40">Hubungan dengan Si Mati *</label>
                        <x-input id="nama" class="form-control w-96" type="text" name="relation"
                            placeholder="Relation" value="" required />
                    </div>

                    <div class="mb-4 flex items-center justify-center gap-4 ml-8">
                        <label for="nama" class="font-semibold text-left w-40">Alamat *</label>
                        <textarea style="border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;" class="block mt-1 w-full"
                            placeholder="Address" rows="3" name="address">{{ old('address', $profile->address ?? '') }}</textarea>
                    </div>

                    <div class="mb-4 flex items-center justify-center gap-4 ml-8">
                        <label for="nama" class="font-semibold text-left w-40">No. Telefon*</label>
                        <x-input id="no_telefon" class="form-control w-96" type="text" name="phone"
                            placeholder="No. Telefon" value="{{ $profile->phone }}" required />
                    </div>
                </div>

                <div class="step-three" data-step="3" style="display: none;">
                    <h3 class="text-lg font-bold mb-4 text-left">C. MAKLUMAT PERKHIDMATAN</h3>

                    <h5 class="text-sm font-bold mb-4 text-center ml-24">HARGA (RM)</h5>

                    <!-- Flex row for input and label side by side -->
                    <div class="mb-4 flex items-center justify-center gap-4 ml-12">
                        <label class="text-left w-40">Jurumandi</label>
                        <label class="text-left w-40">250.00</label>
                        <input class="form-check-input service-checkbox" type="checkbox" value="Jurumandi"
                            data-service="Jurumandi" data-price="250.00" name="services[]">
                    </div>

                    <div class="mb-4 flex items-center justify-center gap-4 ml-12">
                        <label class="text-left w-40">Imam & Talkin</label>
                        <label class="text-left w-40">100.00</label>
                        <input class="form-check-input service-checkbox" type="checkbox" value="Imam & Talkin"
                            data-service="Imam & Talkin" data-price="100.00" name="services[]">
                    </div>

                    <div class="mb-4 flex items-center justify-center gap-4 ml-12">
                        <label class="text-left w-40">Set Kain Kafan</label>
                        <label class="text-left w-40">250.00</label>
                        <input class="form-check-input service-checkbox" type="checkbox" value="Set Kain Kafan"
                            data-service="Set Kain Kafan" data-price="250.00" name="services[]">
                    </div>

                    <div class="mb-4 flex items-center justify-center gap-4 ml-12">
                        <label class="text-left w-40">Sewaan Van</label>
                        <label class="text-left w-40">300.00</label>
                        <input class="form-check-input service-checkbox" type="checkbox" value="Sewaan Van"
                            data-service="Sewaan Van" data-price="300.00" name="services[]">
                    </div>
                </div>

                <div class="step-four" data-step="4" style="display: none;">
                    <h3 class="text-lg font-bold mb-4 text-left">D. BAYARAN</h3>

                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">Services</th>
                                <th scope="col" class="text-center">Harga (RM)</th>
                            </tr>
                        </thead>
                        <tbody id="servicesTableBody">
                            <!-- Dynamic rows will be inserted here -->
                        </tbody>
                    </table>

                    <!-- Align Total Price -->
                    <div class="mt-4 flex items-center justify-end gap-4 ml-12" >
                        <label class="text-left w-40 font-bold">Jumlah Harga (RM):</label>
                        <input class="text-center form-control" style="width: 100px; margin-left:5px;" type="text"
                            id="totalPrice" name="totalPrice" value="0.00" readonly>
                    </div>

                    <h3 class="text-lg font-bold mt-4 text-left">KAEDAH BAYARAN</h3>
                    <div class="md:flex mb-6 ml-8">
                        <div class="md:w-3/3">
                            @if(isset($kKematian) || $kKematian != null)
                            <div class="mt-2 flex">
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio text-indigo-600" name="paymentOpt" required
                                        id="Khairat Kematian" value="Khairat Kematian">
                                        <label class="text-left w-40 font-bold">Khairat Kematian</label>
                                </label>
                            </div>
                            @endif
                            <div class="mt-2 flex">
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio text-indigo-600" name="paymentOpt" required
                                        id="FPX" value="FPX">
                                    <img src="/images/FPX.png" alt="UMPSA" height="60px" width="100px"
                                        class="d-inline-block mx-2">
                                </label>
                            </div>
                            </br>
                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio text-indigo-600" name="paymentOpt"
                                        id="CDM" value="CDM">
                                    <label class="block text-gray-600 font-bold md:text-right mx-1">
                                        Cash Deposit Machine (CDM)
                                    </label>
                                </label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="100px" height="60px"
                                    fill="currentColor" class="bi bi-cash-stack ml-14" viewBox="0 0 16 16">
                                    <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                    <path
                                        d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div id="upload" style="display: none;">
                        <div class="w-64 ml-12">
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="file_input" type="file" name="receipt">
                        </div>
                    </div>
                </div>

                <div class="action-buttons d-flex justify-content-between pt-2 pb-2">

                    <x-button type="button" class="btn btn-secondary w-48" id="backBtn" style="display: none;">
                        {{ __('BACK') }}
                    </x-button>
                    <x-button type="button" class="btn btn-primary w-48 ml-auto" id="nextBtn">
                        {{ __('NEXT') }}
                    </x-button>
                    <x-button type="submit" class="btn btn-success w-48" id="submitBtn" style="display: none;">
                        {{ __('SUBMIT') }}
                    </x-button>
                </div>
            </form>
        </div>

    </div>

    <br />
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentStep = 1;
            const totalSteps = 4;

            // Get the step elements and buttons
            const stepOne = document.querySelector('.step-one');
            const stepTwo = document.querySelector('.step-two');
            const stepThree = document.querySelector('.step-three');
            const stepFour = document.querySelector('.step-four');
            const nextBtn = document.getElementById('nextBtn');
            const backBtn = document.getElementById('backBtn');
            const submitBtn = document.getElementById('submitBtn');

            // Function to show the step
            function showStep(step) {
                // Hide all steps
                document.querySelectorAll('.step-one, .step-two, .step-three, .step-four').forEach(stepDiv => {
                    stepDiv.style.display = 'none';
                });

                // Show the current step
                if (step === 1) {
                    stepOne.style.display = 'block';
                } else if (step === 2) {
                    stepTwo.style.display = 'block';
                } else if (step === 3) {
                    stepThree.style.display = 'block';
                } else if (step === 4) {
                    stepFour.style.display = 'block';
                }

                // Show/hide navigation buttons
                if (step === 1) {
                    backBtn.style.display = 'none';
                    nextBtn.style.display = 'inline-block';
                    submitBtn.style.display = 'none';
                } else if (step === totalSteps) {
                    nextBtn.style.display = 'none';
                    submitBtn.style.display = 'inline-block';
                    backBtn.style.display = 'inline-block';
                } else {
                    backBtn.style.display = 'inline-block';
                    nextBtn.style.display = 'inline-block';
                    submitBtn.style.display = 'none';
                }
            }

            // Handle NEXT button click
            nextBtn.addEventListener('click', function() {
                if (currentStep < totalSteps) {
                    currentStep++;
                    showStep(currentStep);
                }
            });

            // Handle BACK button click
            backBtn.addEventListener('click', function() {
                if (currentStep > 1) {
                    currentStep--;
                    showStep(currentStep);
                }
            });

            // Handle form submission
            document.getElementById('multiStepForm').addEventListener('submit', function(event) {
                event.preventDefault();

                // Use AJAX to submit the form without reloading the page
                const formData = new FormData(this);
                fetch(this.action, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert('Form submitted successfully!');
                        // Optionally, reset the form or redirect
                    })
                    .catch(error => {
                        alert('An error occurred while submitting the form.');
                    });
            });

            // Initialize the first step
            showStep(currentStep);
        });

        document.addEventListener("DOMContentLoaded", function() {
            const checkboxes = document.querySelectorAll(".service-checkbox");
            const tableBody = document.getElementById("servicesTableBody");
            const totalPriceInput = document.getElementById("totalPrice");

            let totalPrice = 0;

            // Function to update the table
            function updateTable() {
                // Clear table
                tableBody.innerHTML = "";

                // Track row number
                let rowNumber = 1;

                // Loop through checkboxes
                checkboxes.forEach((checkbox) => {
                    if (checkbox.checked) {
                        const serviceName = checkbox.dataset.service;
                        const servicePrice = parseFloat(checkbox.dataset.price);

                        // Add row to the table
                        const row = `
                    <tr>
                        <th scope="row" class="text-center">${rowNumber}</th>
                        <td class="text-center">${serviceName}</td>
                        <td class="text-center">${servicePrice.toFixed(2)}</td>
                    </tr>
                `;
                        tableBody.insertAdjacentHTML("beforeend", row);

                        rowNumber++;
                    }
                });
            }

            // Function to calculate total price
            function calculateTotal() {
                totalPrice = 0;

                checkboxes.forEach((checkbox) => {
                    if (checkbox.checked) {
                        totalPrice += parseFloat(checkbox.dataset.price);
                    }
                });

                totalPriceInput.value = totalPrice.toFixed(2);
            }

            // Add event listeners to checkboxes
            checkboxes.forEach((checkbox) => {
                checkbox.addEventListener("change", function() {
                    updateTable();
                    calculateTotal();
                });
            });
        });
    </script>



</x-app-layout>
