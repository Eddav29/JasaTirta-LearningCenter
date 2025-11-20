<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Verification - JTLC Learning Center</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gray-50">
    <div class="min-h-full">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="shrink-0">
                            <img class="h-10 w-10" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="JTLC Logo">
                        </div>
                        <div>
                            <h1 class="text-xl font-semibold text-gray-900">JTLC Learning Center</h1>
                            <p class="text-sm text-gray-600">Certificate Verification</p>
                        </div>
                    </div>
                    <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Back to Home
                    </a>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="max-w-3xl mx-auto">
                <!-- Verification Status -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="px-6 py-8">
                        <!-- Status Icon -->
                        <div class="text-center mb-6">
                            <div class="mx-auto w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h2 class="mt-4 text-2xl font-bold text-gray-900">Certificate Verified</h2>
                            <p class="mt-2 text-gray-600">This is a valid certificate issued by JTLC Learning Center</p>
                        </div>

                        <!-- Certificate Details -->
                        <div class="bg-linear-to-br from-blue-50 to-indigo-100 rounded-lg p-6 border-l-4 border-blue-500">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Certificate Information</h3>
                                    <dl class="space-y-3">
                                        <div>
                                            <dt class="text-sm font-medium text-gray-600">Certificate ID</dt>
                                            <dd class="text-sm text-gray-900 font-mono">{{ $verificationCode }}</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-600">Course Name</dt>
                                            <dd class="text-sm text-gray-900">Advanced Laravel Development</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-600">Recipient</dt>
                                            <dd class="text-sm text-gray-900">John Doe</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-600">Issue Date</dt>
                                            <dd class="text-sm text-gray-900">January 15, 2024</dd>
                                        </div>
                                    </dl>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Course Details</h3>
                                    <dl class="space-y-3">
                                        <div>
                                            <dt class="text-sm font-medium text-gray-600">Duration</dt>
                                            <dd class="text-sm text-gray-900">40 hours</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-600">Final Score</dt>
                                            <dd class="text-sm text-gray-900">92%</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-600">Grade</dt>
                                            <dd class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Excellent
                                            </dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-600">Instructor</dt>
                                            <dd class="text-sm text-gray-900">Dr. Sarah Johnson</dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>
                        </div>

                        <!-- Certificate Preview -->
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Certificate Preview</h3>
                            <div class="bg-white border-2 border-gray-200 rounded-lg p-8 text-center" style="background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\"><defs><pattern id=\"grain\" patternUnits=\"userSpaceOnUse\" width=\"100\" height=\"100\"><circle cx=\"50\" cy=\"50\" r=\"0.5\" fill=\"%23f3f4f6\" opacity=\"0.3\"/></pattern></defs><rect width=\"100\" height=\"100\" fill=\"url(%23grain)\"/></svg>');">
                                <div class="border-4 border-double border-gray-400 p-6">
                                    <div class="text-blue-600 text-lg font-bold mb-2">JTLC Learning Center</div>
                                    <div class="text-2xl font-serif text-gray-800 mb-4">Certificate of Completion</div>
                                    <div class="text-gray-600 mb-2">This is to certify that</div>
                                    <div class="text-xl font-bold text-gray-900 mb-4">John Doe</div>
                                    <div class="text-gray-600 mb-2">has successfully completed</div>
                                    <div class="text-lg font-semibold text-blue-600 mb-4">Advanced Laravel Development</div>
                                    <div class="text-sm text-gray-500">January 15, 2024</div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div class="mt-8 bg-blue-50 rounded-lg p-4">
                            <div class="flex">
                                <div class="shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-blue-800">About This Certificate</h3>
                                    <p class="mt-1 text-sm text-blue-700">
                                        This certificate validates that the recipient has successfully completed the specified course 
                                        with JTLC Learning Center. All certificates are digitally signed and can be verified 
                                        using the unique verification code shown above.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Actions -->
                <div class="mt-6 flex justify-center space-x-4">
                    <button onclick="window.print()" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Print Certificate
                    </button>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 mt-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="text-center text-sm text-gray-500">
                    <p>&copy; {{ date('Y') }} JTLC Learning Center. All rights reserved.</p>
                    <p class="mt-2">For questions about this certificate, please contact us at certificates@jtlc.com</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>