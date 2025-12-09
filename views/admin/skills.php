<?php
require_once __DIR__ . '/../../setting_upload_helper.php';
$skills = getSkills();

// Logic handles by router
?>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php $flash = getFlash(); if($flash): ?>
<script>
    Swal.fire({
        icon: '<?php echo $flash['type']; ?>',
        title: '<?php echo ucfirst($flash['type']); ?>',
        text: '<?php echo $flash['message']; ?>',
        timer: 3000,
        showConfirmButton: false,
        background: '#111',
        color: '#fff'
    });
</script>
<?php endif; ?>

<div class="max-w-4xl mx-auto px-4 py-12">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-mono font-bold text-white">Skill_Matrix</h1>
            <p class="text-gray-500 mt-1 font-mono text-xs">Manage known technologies and frameworks.</p>
        </div>
        <a href="<?php echo BASE_URL; ?>/?page=admin" class="text-gray-400 hover:text-white px-4 py-2 border border-gray-700 hover:border-white rounded transition-colors font-mono text-sm">
            < Back
        </a>
    </div>

    <!-- Add New Skill Form -->
    <div class="bg-gray-900 border border-gray-800 rounded-lg p-8 shadow-lg mb-10">
        <h2 class="text-xl font-mono font-bold text-primary mb-6">Install_Module()</h2>
        <form method="POST" enctype="multipart/form-data" class="flex flex-col md:flex-row gap-4 items-end">
            <input type="hidden" name="action" value="add">
            
            <div class="flex-1 w-full">
                <label class="block text-gray-400 font-mono text-xs mb-2 uppercase">Module Name</label>
                <input type="text" name="name" required placeholder="e.g. Docker" class="w-full bg-black border border-gray-700 text-white rounded p-2 focus:border-primary focus:ring-1 focus:ring-primary outline-none font-mono">
            </div>
            
            <div class="flex-1 w-full">
                <label class="block text-gray-400 font-mono text-xs mb-2 uppercase">Source Type</label>
                <select name="icon_source" id="sourceSelect" class="w-full bg-black border border-gray-700 text-white rounded p-2 focus:border-primary focus:ring-1 focus:ring-primary outline-none font-mono" onchange="toggleSource()">
                    <option value="link">CDN Link (URL)</option>
                    <option value="upload">Local File (Upload)</option>
                </select>
            </div>
            
            <div class="flex-[1.5] w-full">
                <label class="block text-gray-400 font-mono text-xs mb-2 uppercase">Icon Path</label>
                <!-- URL Input -->
                <input type="url" name="icon_link" id="linkInput" placeholder="https://..." class="w-full bg-black border border-gray-700 text-white rounded p-2 focus:border-primary focus:ring-1 focus:ring-primary outline-none font-mono">
                <!-- File Input -->
                <input type="file" name="icon_file" id="fileInput" accept="image/*" class="w-full text-sm text-gray-400 hidden">
            </div>
            
            <button type="submit" class="btn-primary-hover w-full md:w-auto px-6 py-2.5 font-bold font-mono rounded transition-colors">
                INSTALL
            </button>
        </form>
    </div>

    <!-- Skills List -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        <?php foreach($skills as $skill): ?>
        <div class="bg-gray-900 border border-gray-800 rounded p-4 flex flex-col items-center relative group hover:border-primary/50 transition-colors">
            <div class="w-12 h-12 mb-3 bg-black rounded flex items-center justify-center border border-gray-700">
                <img src="<?php echo $skill['icon_value']; ?>" class="w-8 h-8 object-contain" alt="Icon">
            </div>
            <span class="font-bold text-white font-mono text-sm"><?php echo htmlspecialchars($skill['name']); ?></span>
            <span class="text-[10px] text-gray-500 mt-1 uppercase font-mono tracking-wider"><?php echo $skill['icon_source']; ?></span>
            
            <form method="POST" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity" onsubmit="return confirm('Uninstall this module?');">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="<?php echo $skill['id']; ?>">
                <button type="submit" class="text-red-500 hover:text-red-400 p-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </form>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
function toggleSource() {
    const val = document.getElementById('sourceSelect').value;
    const linkInput = document.getElementById('linkInput');
    const fileInput = document.getElementById('fileInput');
    
    if (val === 'link') {
        linkInput.classList.remove('hidden');
        linkInput.required = true;
        fileInput.classList.add('hidden');
        fileInput.required = false;
    } else {
        linkInput.classList.add('hidden');
        linkInput.required = false;
        fileInput.classList.remove('hidden');
        fileInput.required = true;
    }
}
</script>
