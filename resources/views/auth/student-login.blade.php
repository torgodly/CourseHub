
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body
    class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 flex items-center justify-center p-4 relative overflow-hidden">
    <div class="w-full max-w-md mx-auto relative z-10">
        <div class="bg-white rounded-3xl shadow-xl p-8 border-2 border-gray-100">
            <div class="text-center mb-8">
                <h1
                    class="text-4xl font-bold bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                    Welcome Back</h1>
                <p class="text-lg text-gray-600 font-medium">Login to your account</p>
            </div>

            <form method="POST" action="{{ route('login.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email Address</label>
                    <input type="email" name="email" id="email"
                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-blue-500 transition-all"
                        required autofocus>
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                    <input type="password" name="password" id="password"
                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-blue-500 transition-all"
                        required>
                </div>

                <div class="text-center">
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-xl font-bold py-3 px-4 hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-blue-500/40">
                        Login
                    </button>
                </div>
            </form>

            <div class="text-center mt-6">
                <p class="text-gray-600">Don't have an account? <a href="{{ route('register') }}"
                        class="text-blue-600 hover:text-blue-700 font-bold transition-colors duration-300">Register</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
