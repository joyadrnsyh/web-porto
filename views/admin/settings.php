<?php
require_once __DIR__ . '/../../setting_upload_helper.php';
$settings = getSettings();

// Logic is handled in index.php router for POST redirect
?>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php 
$flash = getFlash();
if($flash): 
?>
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
            <h1 class="text-3xl font-mono font-bold text-white">System_Configuration</h1>
            <p class="text-gray-500 mt-1 font-mono text-xs">Adjust global variables and assets.</p>
        </div>
        <a href="<?php echo BASE_URL; ?>/?page=admin" class="text-gray-400 hover:text-white px-4 py-2 border border-gray-700 hover:border-white rounded transition-colors font-mono text-sm">
            < Back
        </a>
    </div>

    <form method="POST" enctype="multipart/form-data" class="space-y-8 h-full">
        <!-- Hero Section -->
        <div class="bg-gray-900 border border-gray-800 rounded-lg p-8 shadow-lg">
            <h2 class="text-xl font-mono font-bold text-primary mb-6 flex items-center gap-2">
                // Hero_Section
            </h2>
            <div class="grid gap-6">
                <div>
                    <label class="block text-gray-400 font-mono text-xs mb-2 uppercase">Main Headline</label>
                    <input type="text" name="hero_title" value="<?php echo htmlspecialchars($settings['hero_title'] ?? ''); ?>" class="w-full bg-black border border-gray-700 text-white rounded p-3 focus:border-primary focus:ring-1 focus:ring-primary outline-none font-mono">
                </div>
                <div>
                    <label class="block text-gray-400 font-mono text-xs mb-2 uppercase">Sub Headline</label>
                    <textarea name="hero_subtitle" rows="2" class="w-full bg-black border border-gray-700 text-white rounded p-3 focus:border-primary focus:ring-1 focus:ring-primary outline-none font-mono"><?php echo htmlspecialchars($settings['hero_subtitle'] ?? ''); ?></textarea>
                </div>
                <div>
                     <label class="block text-gray-400 font-mono text-xs mb-2 uppercase">Hero Image</label>
                     <div class="flex items-center gap-4 bg-black border border-gray-700 p-4 rounded">
                        <?php if(isset($settings['hero_image'])): ?>
                            <img src="<?php echo $settings['hero_image']; ?>" class="h-20 w-20 object-cover rounded border border-gray-600">
                        <?php endif; ?>
                        <input type="file" name="hero_image" accept="image/*" class="text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-primary file:text-black hover:file:bg-white transition-colors">
                     </div>
                </div>
            </div>
        </div>

        <!-- About Section -->
        <div class="bg-gray-900 border border-gray-800 rounded-lg p-8 shadow-lg">
            <h2 class="text-xl font-mono font-bold text-primary mb-6 flex items-center gap-2">
                // About_Me
            </h2>
            <div class="space-y-6">
                <div>
                    <label class="block text-gray-400 font-mono text-xs mb-2 uppercase">Bio Description</label>
                    <textarea name="about_bio" rows="4" class="w-full bg-black border border-gray-700 text-white rounded p-3 focus:border-primary focus:ring-1 focus:ring-primary outline-none font-mono"><?php echo htmlspecialchars($settings['about_bio'] ?? ''); ?></textarea>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php 
                    $defaultFeats = ['Web Development', 'UI/UX Design', 'Mobile Friendly', 'SEO Optimization'];
                    for($i=1; $i<=4; $i++): 
                    ?>
                    <div class="bg-black border border-gray-700 p-4 rounded">
                        <label class="block text-gray-500 text-xs font-mono mb-2">FEATURE_0<?php echo $i; ?></label>
                        <div class="flex items-center gap-3 mb-3">
                             <?php if(isset($settings["about_feat_{$i}_icon"])): ?>
                                <img src="<?php echo $settings["about_feat_{$i}_icon"]; ?>" class="h-8 w-8 object-contain bg-gray-800 rounded p-1">
                            <?php endif; ?>
                            <input type="file" name="about_feat_<?php echo $i; ?>_icon" accept="image/*" class="w-full text-xs text-gray-500">
                        </div>
                        <input type="text" name="about_feat_<?php echo $i; ?>_text" value="<?php echo htmlspecialchars($settings["about_feat_{$i}_text"] ?? $defaultFeats[$i-1]); ?>" class="w-full bg-gray-900 border border-gray-600 text-white rounded px-3 py-2 text-sm font-mono focus:border-primary outline-none">
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
        
        <!-- Services Section -->
        <div class="bg-gray-900 border border-gray-800 rounded-lg p-8 shadow-lg">
            <h2 class="text-xl font-mono font-bold text-primary mb-6 flex items-center gap-2">
                // Services
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- S1 -->
                <div class="bg-black border border-gray-700 p-4 rounded">
                    <h3 class="font-bold text-white mb-4 font-mono">Service [0]</h3>
                    <div class="space-y-4">
                        <div>
                             <div class="flex items-center gap-2">
                                <?php if(isset($settings['service_1_icon'])): ?>
                                    <img src="<?php echo $settings['service_1_icon']; ?>" class="h-8 w-8 object-contain">
                                <?php endif; ?>
                                <input type="file" name="service_1_icon" accept="image/*" class="w-full text-xs text-gray-500">
                             </div>
                        </div>
                        <input type="text" name="service_1_title" value="<?php echo htmlspecialchars($settings['service_1_title'] ?? ''); ?>" placeholder="Title" class="w-full bg-gray-900 border border-gray-600 text-white rounded px-3 py-2 text-sm font-mono focus:border-primary outline-none">
                        <textarea name="service_1_desc" rows="3" placeholder="Description" class="w-full bg-gray-900 border border-gray-600 text-white rounded px-3 py-2 text-sm font-mono focus:border-primary outline-none"><?php echo htmlspecialchars($settings['service_1_desc'] ?? ''); ?></textarea>
                    </div>
                </div>
                 <!-- S2 -->
                <div class="bg-black border border-gray-700 p-4 rounded">
                    <h3 class="font-bold text-white mb-4 font-mono">Service [1]</h3>
                    <div class="space-y-4">
                        <div>
                             <div class="flex items-center gap-2">
                                <?php if(isset($settings['service_2_icon'])): ?>
                                    <img src="<?php echo $settings['service_2_icon']; ?>" class="h-8 w-8 object-contain">
                                <?php endif; ?>
                                <input type="file" name="service_2_icon" accept="image/*" class="w-full text-xs text-gray-500">
                             </div>
                        </div>
                        <input type="text" name="service_2_title" value="<?php echo htmlspecialchars($settings['service_2_title'] ?? ''); ?>" placeholder="Title" class="w-full bg-gray-900 border border-gray-600 text-white rounded px-3 py-2 text-sm font-mono focus:border-primary outline-none">
                        <textarea name="service_2_desc" rows="3" placeholder="Description" class="w-full bg-gray-900 border border-gray-600 text-white rounded px-3 py-2 text-sm font-mono focus:border-primary outline-none"><?php echo htmlspecialchars($settings['service_2_desc'] ?? ''); ?></textarea>
                    </div>
                </div>
                 <!-- S3 -->
                <div class="bg-black border border-gray-700 p-4 rounded">
                    <h3 class="font-bold text-white mb-4 font-mono">Service [2]</h3>
                    <div class="space-y-4">
                        <div>
                             <div class="flex items-center gap-2">
                                <?php if(isset($settings['service_3_icon'])): ?>
                                    <img src="<?php echo $settings['service_3_icon']; ?>" class="h-8 w-8 object-contain">
                                <?php endif; ?>
                                <input type="file" name="service_3_icon" accept="image/*" class="w-full text-xs text-gray-500">
                             </div>
                        </div>
                        <input type="text" name="service_3_title" value="<?php echo htmlspecialchars($settings['service_3_title'] ?? ''); ?>" placeholder="Title" class="w-full bg-gray-900 border border-gray-600 text-white rounded px-3 py-2 text-sm font-mono focus:border-primary outline-none">
                        <textarea name="service_3_desc" rows="3" placeholder="Description" class="w-full bg-gray-900 border border-gray-600 text-white rounded px-3 py-2 text-sm font-mono focus:border-primary outline-none"><?php echo htmlspecialchars($settings['service_3_desc'] ?? ''); ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact/Social -->
        <div class="bg-gray-900 border border-gray-800 rounded-lg p-8 shadow-lg">
            <h2 class="text-xl font-mono font-bold text-primary mb-6 flex items-center gap-2">
                // Communication_Link
            </h2>
            <div>
                <label class="block text-gray-400 font-mono text-xs mb-2 uppercase">WhatsApp Number</label>
                <input type="text" name="contact_whatsapp" value="<?php echo htmlspecialchars($settings['contact_whatsapp'] ?? ''); ?>" placeholder="6281234..." class="w-full bg-black border border-gray-700 text-white rounded p-3 focus:border-primary focus:ring-1 focus:ring-primary outline-none font-mono">
            </div>
        </div>
        
        <button type="submit" class="btn-primary-hover w-full py-4 font-bold font-mono text-lg rounded transition-colors shadow-[0_0_15px_theme('colors.primary')]">
            APPLY_CHANGES()
        </button>
    </form>
</div>

