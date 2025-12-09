<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    if ($password === ADMIN_PASSWORD) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: ' . BASE_URL . '/?page=admin');
        exit;
    } else {
        $error = "ACCESS_DENIED: Invalid credentials.";
    }
}
?>
<div class="min-h-screen flex items-center justify-center bg-dark relative overflow-hidden">
    <!-- Background Effects -->
    <div class="fixed inset-0 z-0 bg-grid-pattern bg-grid opacity-[0.2] pointer-events-none"></div>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-primary rounded-full mix-blend-screen filter blur-[100px] opacity-10"></div>

    <div class="max-w-md w-full mx-4 z-10">
        <div class="bg-gray-900 border border-gray-800 p-8 rounded-lg shadow-[0_0_20px_theme('colors.primary')] relative overflow-hidden backdrop-blur-sm">
            <!-- Top Deco -->
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-primary to-transparent opacity-50"></div>
            
            <div class="text-center mb-8">
                <h2 class="text-3xl font-mono font-bold text-white mb-2">>_ Admin_Panel</h2>
                <p class="text-gray-500 font-mono text-xs">SECURE_CONNECTION_ESTABLISHED</p>
            </div>
            
            <?php if (isset($error)): ?>
                <div class="bg-red-900/20 border border-red-500/50 text-red-500 px-4 py-3 rounded mb-6 font-mono text-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-6">
                <div>
                    <label class="block text-primary font-mono text-xs mb-2 tracking-wider">ENTER_PASSWORD</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 font-mono">></span>
                        </div>
                        <input type="password" name="password" required class="block w-full pl-8 pr-3 py-3 bg-dark border border-gray-700 rounded text-gray-200 placeholder-gray-600 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary font-mono transition-all" placeholder="********">
                    </div>
                </div>
                
                <button type="submit" class="btn-primary-hover w-full py-3 px-4 font-bold font-mono rounded shadow-[0_0_10px_theme('colors.primary')]">
                    AUTHENTICATE
                </button>
            </form>
            
            <div class="mt-8 text-center">
                 <a href="<?php echo BASE_URL; ?>" class="text-gray-600 hover:text-gray-400 text-xs font-mono no-underline hover:underline">
                    &lt; Return_To_Base
                 </a>
            </div>
        </div>
    </div>
</div>
