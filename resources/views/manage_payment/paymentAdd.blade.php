<x-app-layout>
    <br />
    <div class="container text-center">
        <h1 class="text-4xl">MANAGE KHAIRAT KEMATIAN</h1>
        <br />

        <div id='section2' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">

            <form method="POST" action="#"
                enctype="multipart/form-data">
                @csrf
                <div class="md:flex mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="feeType">
                            Fee Type :
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                            id="feeType" type="text" value="#" disabled>
                        <input type="hidden" value="#" name="feeType">
                        <input type="hidden" value="#" name="uID">
                    </div>
                </div>

                <div class="md:flex mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="name">
                            Name :
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                            id="name" type="text" value="#" disabled>
                            <input type="hidden" value="#" name="name">
                    </div>
                </div>

                <div class="md:flex mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="phone">
                            Phone No. :
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input
                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                            id="phone" type="text" value="#" disabled>
                            <input type="hidden" value="#" name="phone">
                            <input type="hidden" value="#" name="email">
                    </div>
                </div>

                <div class="md:flex mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="total">
                            Payment Total (MYR) :
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input class="form-input block w-full focus:bg-white" id="total" type="number"
                            step=".01"  min="1" name="total">
                    </div>
                </div>

                <div class="md:flex mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="remark">
                            Remark :
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <textarea class="form-textarea block w-full focus:bg-white" id="remark" name="remark" rows="4"></textarea>
                    </div>
                </div>

                <div class="md:flex mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="paymentOpt">
                            Payment Type :
                        </label>
                    </div>
                    <div class="md:w-3/3">
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="100px" height="60px" fill="currentColor"
                                class="bi bi-cash-stack ml-14" viewBox="0 0 16 16">
                                <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                <path
                                    d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div id="upload" style="display:none;">
                    <div class="md:flex mb-6" id="uploadFile">
                        <div class="md:w-1/3"></div>
                        <div class="md:w-2/3">
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="file_input" type="file" name="receipt">
                        </div>
                    </div>
                </div>

                <div class="md:flex md:items-center">
                    <div class="md:w-1/3"></div>
                    <div class="md:w-2/3">
                        <x-button
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm h-10 px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            {{ __('CONFIRM') }}
                        </x-button>
                    </div>
                </div>
            </form>

        </div>

        <br />
    </div>
</x-app-layout>
