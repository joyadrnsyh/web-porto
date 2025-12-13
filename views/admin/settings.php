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
        background: '#18181b', // Zinc 900
        color: '#f4f4f5'
    });
</script>
<?php endif; ?>

<div class="max-w-5xl mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-10">
        <div>
            <h1 class="text-3xl font-display font-bold text-white tracking-tight">Settings</h1>
            <p class="text-text-muted mt-2 text-sm">Manage your portfolio content and global configurations.</p>
        </div>
        <a href="<?php echo BASE_URL; ?>/?page=admin" class="flex items-center gap-2 text-sm text-text-muted hover:text-white transition-colors px-4 py-2 rounded-full border border-white/5 hover:bg-white/5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Dashboard
        </a>
    </div>

    <form method="POST" enctype="multipart/form-data" class="space-y-6 md:space-y-8">
        <!-- Hero Section -->
        <section class="glass-panel p-6 md:p-8 rounded-2xl">
            <div class="flex items-center gap-3 mb-6 md:mb-8 border-b border-white/5 pb-4">
                <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-white">Hero Section</h2>
                    <p class="text-xs text-text-muted">Main landing area content.</p>
                </div>
            </div>

            <div class="grid gap-4 md:gap-6">
                <div>
                    <label class="block text-text-muted text-xs font-medium mb-2 uppercase tracking-wide">Headline</label>
                    <input type="text" name="hero_title" value="<?php echo htmlspecialchars($settings['hero_title'] ?? ''); ?>" class="w-full bg-surface-light border border-white/5 text-white rounded-xl p-4 focus:border-primary/50 focus:ring-1 focus:ring-primary/50 outline-none transition-all placeholder-gray-600" placeholder="e.g. Creative Developer">
                </div>
                <div>
                    <label class="block text-text-muted text-xs font-medium mb-2 uppercase tracking-wide">Sub Headline</label>
                    <textarea name="hero_subtitle" rows="2" class="w-full bg-surface-light border border-white/5 text-white rounded-xl p-4 focus:border-primary/50 focus:ring-1 focus:ring-primary/50 outline-none transition-all placeholder-gray-600" placeholder="A brief introduction..."><?php echo htmlspecialchars($settings['hero_subtitle'] ?? ''); ?></textarea>
                </div>
                <div>
                     <label class="block text-text-muted text-xs font-medium mb-2 uppercase tracking-wide">Hero Image</label>
                     <div class="flex flex-col sm:flex-row items-center sm:items-start gap-4 sm:gap-6 p-4 bg-surface-light/50 rounded-xl border border-white/5">
                        <?php if(isset($settings['hero_image'])): ?>
                            <div class="shrink-0 relative group">
                                <img src="<?php echo $settings['hero_image']; ?>" class="h-24 w-24 object-cover rounded-lg shadow-lg">
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center text-xs text-white">
                                    Current
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="flex-1 w-full">
                            <input type="file" name="hero_image" accept="image/*" class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition-all cursor-pointer">
                            <p class="mt-2 text-xs text-gray-500">Recommended: PNG or JPG, approx 500x500px.</p>
                        </div>
                     </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section class="glass-panel p-6 md:p-8 rounded-2xl">
            <div class="flex items-center gap-3 mb-6 md:mb-8 border-b border-white/5 pb-4">
                 <div class="w-10 h-10 rounded-full bg-secondary/10 flex items-center justify-center text-secondary">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-white">About Me</h2>
                    <p class="text-xs text-text-muted">Bio and key features.</p>
                </div>
            </div>
            
            <div class="space-y-4 md:space-y-6">
                <div>
                    <label class="block text-text-muted text-xs font-medium mb-2 uppercase tracking-wide">Biography</label>
                    <textarea name="about_bio" rows="4" class="w-full bg-surface-light border border-white/5 text-white rounded-xl p-4 focus:border-secondary/50 focus:ring-1 focus:ring-secondary/50 outline-none transition-all placeholder-gray-600"><?php echo htmlspecialchars($settings['about_bio'] ?? ''); ?></textarea>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php 
                    $defaultFeats = ['Web Development', 'UI/UX Design', 'Mobile Friendly', 'SEO Optimization'];
                    for($i=1; $i<=4; $i++): 
                    ?>
                    <div class="p-4 rounded-xl bg-surface-light/30 border border-white/5 hover:border-white/10 transition-colors">
                        <label class="block text-xs font-medium text-gray-500 mb-3">Feature 0<?php echo $i; ?></label>
                        <div class="flex items-center gap-4 mb-3">
                             <?php if(isset($settings["about_feat_{$i}_icon"])): ?>
                                <img src="<?php echo $settings["about_feat_{$i}_icon"]; ?>" class="h-10 w-10 object-contain p-1.5 bg-background rounded-lg border border-white/5">
                            <?php endif; ?>
                            <input type="file" name="about_feat_<?php echo $i; ?>_icon" accept="image/*" class="w-full text-xs text-gray-500 file:mr-2 file:py-1 file:px-3 file:rounded-md file:border-0 file:bg-gray-800 file:text-gray-300 hover:file:bg-gray-700">
                        </div>
                        <input type="text" name="about_feat_<?php echo $i; ?>_text" value="<?php echo htmlspecialchars($settings["about_feat_{$i}_text"] ?? $defaultFeats[$i-1]); ?>" class="w-full bg-background border border-white/5 text-white rounded-lg px-3 py-2 text-sm focus:border-secondary/50 outline-none">
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
        </section>
        
        <!-- Services Section -->
        <section class="glass-panel p-6 md:p-8 rounded-2xl">
             <div class="flex items-center gap-3 mb-6 md:mb-8 border-b border-white/5 pb-4">
                 <div class="w-10 h-10 rounded-full bg-accent/10 flex items-center justify-center text-accent">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-white">Services</h2>
                    <p class="text-xs text-text-muted">Service cards details.</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                <?php for($k=1; $k<=3; $k++): ?>
                <div class="bg-surface-light/30 border border-white/5 p-5 rounded-xl hover:border-accent/30 transition-colors group">
                    <h3 class="font-bold text-white text-sm mb-4 flex items-center justify-between">
                        Service <?php echo $k; ?>
                        <span class="w-2 h-2 rounded-full bg-accent opacity-50 group-hover:opacity-100"></span>
                    </h3>
                    
                    <div class="space-y-4">
                        <div class="p-3 bg-background rounded-lg border border-white/5">
                             <div class="flex items-center gap-2">
                                <?php if(isset($settings["service_{$k}_icon"])): ?>
                                    <img src="<?php echo $settings["service_{$k}_icon"]; ?>" class="h-8 w-8 object-contain">
                                <?php endif; ?>
                                <input type="file" name="service_<?php echo $k; ?>_icon" accept="image/*" class="w-full text-xs text-gray-500">
                             </div>
                        </div>
                        <input type="text" name="service_<?php echo $k; ?>_title" value="<?php echo htmlspecialchars($settings["service_{$k}_title"] ?? ''); ?>" placeholder="Service Title" class="w-full bg-background border border-white/5 text-white rounded-lg px-3 py-2 text-sm focus:border-accent/50 outline-none">
                        <textarea name="service_<?php echo $k; ?>_desc" rows="3" placeholder="Description" class="w-full bg-background border border-white/5 text-white rounded-lg px-3 py-2 text-sm focus:border-accent/50 outline-none resize-none"><?php echo htmlspecialchars($settings["service_{$k}_desc"] ?? ''); ?></textarea>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
        </section>

        <!-- Contact/Social -->
        <section class="glass-panel p-6 md:p-8 rounded-2xl">
             <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-full bg-green-500/10 flex items-center justify-center text-green-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                </div>
                <div>
                     <h2 class="text-lg font-bold text-white">Contact</h2>
                </div>
            </div>
            <div>
                <label class="block text-text-muted text-xs font-medium mb-2 uppercase tracking-wide">WhatsApp Number</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm font-medium">+</span>
                    <input type="text" name="contact_whatsapp" value="<?php echo htmlspecialchars($settings['contact_whatsapp'] ?? ''); ?>" placeholder="6281234..." class="w-full bg-surface-light border border-white/5 text-white rounded-xl py-4 pl-8 pr-4 focus:border-green-500/50 focus:ring-1 focus:ring-green-500/50 outline-none transition-all font-mono">
                </div>
                <p class="text-xs text-gray-500 mt-2">Enter number without +, e.g. 62812345678</p>
            </div>
        </section>
        
        <div class="sticky bottom-4 z-40">
            <div class="bg-black/80 backdrop-blur border border-white/10 p-4 rounded-2xl flex flex-col sm:flex-row items-center justify-between gap-4 shadow-2xl max-w-5xl mx-auto">
                <span class="text-xs md:text-sm text-gray-400">Unsaved changes will be lost.</span>
                <button type="submit" class="w-full sm:w-auto bg-primary hover:bg-primary-dark text-white text-sm font-bold uppercase tracking-wider py-3 px-8 rounded-xl transition-all shadow-lg shadow-primary/20 transform hover:-translate-y-1">
                    Save Changes
                </button>
            </div>
        </div>
    </form>
</div>

