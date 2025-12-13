<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    if ($password === ADMIN_PASSWORD) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: ' . BASE_URL . '/?page=admin');
        exit;
    } else {
        $error = "Invalid password provided.";
    }
}
?>
<div class="min-h-screen flex items-center justify-center bg-dark relative overflow-hidden">
    <!-- Background Effects -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-[-10%] right-[-5%] w-[500px] h-[500px] bg-primary/20 rounded-full blur-[100px] opacity-20 animate-pulse"></div>
        <div class="absolute bottom-[-10%] left-[-5%] w-[400px] h-[400px] bg-secondary/20 rounded-full blur-[100px] opacity-20"></div>
    </div>

    <div class="max-w-md w-full mx-4 z-10">
        <div class="bg-surface border border-surface-light/30 p-10 rounded-2xl shadow-2xl relative overflow-hidden backdrop-blur-xl">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-display font-bold text-white mb-2">Admin Login</h2>
                <p class="text-gray-400 text-sm">Please enter your credentials to continue.</p>
            </div>
            
            <?php if (isset($error)): ?>
                <div class="bg-red-500/10 border border-red-500/20 text-red-500 px-4 py-3 rounded-lg mb-6 text-sm font-medium flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-6">
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Password</label>
                    <input type="password" name="password" required class="block w-full px-4 py-3 bg-surface-light/30 border border-surface-light/50 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all" placeholder="Enter your password">
                </div>
                
                <button type="submit" class="w-full py-3 px-4 font-bold text-white bg-primary hover:bg-indigo-600 rounded-xl shadow-lg shadow-indigo-500/30 transition-all transform hover:-translate-y-0.5">
                    Sign In
                </button>
            </form>
            
            <div class="mt-8 text-center">
                 <a href="<?php echo BASE_URL; ?>" class="text-gray-500 hover:text-white text-sm font-medium transition-colors">
                    ← Return to Home
                 </a>
            </div>
        </div>
    </div>
</div>
