<?php
session_start();
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - MANIFEST</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#0b0c10] text-[#c5c6c7] min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-[#1f2833]/40 backdrop-blur-md border border-[#45a29e]/20 p-8 rounded-3xl shadow-2xl">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white tracking-tight">Admin <span class="text-[#45a29e]">Portal</span></h1>
            <p class="text-sm text-gray-400 mt-2">Sign in to manage MANIFEST dashboard</p>
        </div>

        <div id="error-box" class="hidden mb-4 p-4 bg-red-500/10 border border-red-500/30 text-red-400 text-sm rounded-xl text-center"></div>

        <form id="login-form" class="space-y-5">
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Username</label>
                <input type="text" name="username" required class="w-full bg-[#0b0c10]/60 border border-[#45a29e]/20 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-[#45a29e] transition-all">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Password</label>
                <input type="password" name="password" required class="w-full bg-[#0b0c10]/60 border border-[#45a29e]/20 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-[#45a29e] transition-all">
            </div>
            <button type="submit" class="w-full bg-[#45a29e] hover:bg-[#66fcf1] text-[#0b0c10] font-semibold py-3 rounded-xl transition-all shadow-lg shadow-[#45a29e]/20">
                Sign In
            </button>
        </form>
    </div>

    <script>
        document.getElementById('login-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const errorBox = document.getElementById('error-box');
            errorBox.classList.add('hidden');

            const formData = new FormData(e.target);
            try {
                const response = await fetch('../api/admin/login.php', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();

                if (result.status === 'success') {
                    window.location.href = 'index.php';
                } else {
                    errorBox.textContent = result.message;
                    errorBox.classList.remove('hidden');
                }
            } catch (error) {
                errorBox.textContent = 'Something went wrong. Please try again.';
                errorBox.classList.remove('hidden');
            }
        });
    </script>
</body>
</html>