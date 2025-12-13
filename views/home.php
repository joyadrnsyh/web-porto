<?php
$projects = getProjects(3); // Show top 3 featuring
$settings = getSettings();
?>

<!-- Hero Section -->
<section id="home" class="min-h-screen flex items-center pt-20 md:pt-28 relative overflow-hidden">
    <div class="max-w-screen-xl mx-auto px-4 z-10 w-full grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
        <div class="space-y-6 md:space-y-8" data-aos="fade-right">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-surface-light/50 border border-white/5 backdrop-blur-sm">
                <span class="flex h-2 w-2 relative mr-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
                </span>
                <span class="text-xs md:text-sm font-medium text-text-muted tracking-wide">Available for Freelance Work</span>
            </div>
            
            <h1 class="text-4xl sm:text-5xl md:text-7xl font-display font-medium text-white leading-[1.1] tracking-tight">
                <?php echo htmlspecialchars($settings['hero_title'] ?? 'Building digital products that matter.'); ?>
            </h1>
            
            <p class="text-base md:text-lg text-text-muted leading-relaxed max-w-lg" data-aos="fade-up" data-aos-delay="200">
                 <?php echo nl2br(htmlspecialchars($settings['hero_subtitle'] ?? 'I help brands and businesses create impactful digital experiences through code and design.')); ?>
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 pt-4" data-aos="fade-up" data-aos-delay="400">
                <a href="#projects" class="px-8 py-4 bg-white text-black font-semibold rounded-full hover:bg-gray-200 transition-all transform hover:-translate-y-1 text-center">
                    View My Work
                </a>
                <a href="https://wa.me/<?php echo htmlspecialchars($settings['contact_whatsapp'] ?? ''); ?>" class="px-8 py-4 border border-white/10 text-white font-medium rounded-full hover:bg-white/5 transition-all text-center">
                    Contact Me
                </a>
            </div>
        </div>
        
        <div class="relative hidden lg:block" data-aos="fade-left" data-aos-delay="200">
            <!-- Ambient Glow -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gradient-to-tr from-primary/20 to-secondary/20 rounded-full blur-[100px] -z-10 animate-pulse"></div>
            
             <?php 
                $heroImage = isset($settings['hero_image']) && !empty($settings['hero_image']) 
                    ? $settings['hero_image'] 
                    : 'https://images.unsplash.com/photo-1544256327-3b959902733d?q=80&w=2000&auto=format&fit=crop';
            ?>
            <div class="relative rounded-[2rem] overflow-hidden border border-white/10 p-2 ring-1 ring-white/5 shadow-2xl rotate-3 hover:rotate-0 transition-all duration-700">
                <img src="<?php echo $heroImage; ?>" class="rounded-[1.5rem] w-full h-[550px] object-cover grayscale-[20%] hover:grayscale-0 transition-all duration-700" alt="Profile">
                
                <!-- Floating Badge -->
                <div class="absolute bottom-8 left-8 p-4 bg-black/60 backdrop-blur-xl border border-white/10 rounded-2xl shadow-xl flex items-center gap-4 animate-float" data-aos="zoom-in" data-aos-delay="600">
                    <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center text-black font-bold">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-white">Full Stack</p>
                        <p class="text-xs text-gray-400">Developer & Designer</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-20 md:py-32 relative">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-20 items-center">
            <div class="space-y-8" data-aos="fade-right">
                 <h2 class="text-3xl md:text-4xl font-display font-medium text-white">
                    About <span class="text-text-muted">Me</span>
                </h2>
                
                <div class="prose prose-lg prose-invert text-text-muted leading-relaxed font-light">
                    <p>
                        <?php echo htmlspecialchars($settings['about_bio'] ?? 'Hello! I am a passionate developer dedicated to building high-quality web applications. I love solving complex problems and learning new technologies.'); ?>
                    </p>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4">
                    <?php 
                    $defaultFeats = ['Web Development', 'UI/UX Design', 'Mobile Optimization', 'SEO Friendly'];
                    for($i=1; $i<=4; $i++):
                        $text = $settings["about_feat_{$i}_text"] ?? $defaultFeats[$i-1];
                        $iconUrl = $settings["about_feat_{$i}_icon"] ?? null;
                    ?>
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-surface-light/30 border border-white/5 hover:border-white/10 transition-all group" data-aos="fade-up" data-aos-delay="<?php echo $i * 100; ?>">
                        <?php if($iconUrl): ?>
                            <img src="<?php echo $iconUrl; ?>" class="w-6 h-6 object-contain opacity-70 group-hover:opacity-100">
                        <?php else: ?>
                            <div class="w-8 h-8 flex items-center justify-center bg-white/5 rounded-lg text-white group-hover:bg-primary group-hover:text-black transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                        <?php endif; ?>
                        <span class="font-medium text-gray-300 group-hover:text-white transition-colors"><?php echo htmlspecialchars($text); ?></span>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
            
            <div class="relative" data-aos="fade-left">
                <div class="glass-panel p-6 md:p-8 rounded-3xl">
                    <h3 class="text-xl font-display font-bold text-white mb-6">Technical Skills</h3>
                    <div class="flex flex-wrap gap-2">
                        <?php 
                        $skills = getSkills();
                        foreach($skills as $key => $skill): 
                        ?>
                        <div class="px-4 py-3 bg-surface rounded-xl border border-white/5 flex items-center gap-3 hover:border-white/20 transition-colors cursor-default" data-aos="zoom-in" data-aos-delay="<?php echo $key * 50; ?>">
                            <img src="<?php echo $skill['icon_value']; ?>" class="w-5 h-5 object-contain grayscale group-hover:grayscale-0" alt="<?php echo htmlspecialchars($skill['name']); ?>">
                            <span class="text-sm font-medium text-gray-300"><?php echo htmlspecialchars($skill['name']); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="py-20 md:py-32 border-t border-white/5">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="text-center mb-16 md:mb-20" data-aos="fade-up">
            <h2 class="text-sm font-bold text-primary tracking-widest uppercase mb-3">Capabilities</h2>
            <h3 class="text-3xl md:text-5xl font-display font-medium text-white">Services</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Service 1 -->
            <div class="p-8 rounded-3xl bg-surface-light/20 border border-white/5 hover:bg-surface-light/30 hover:border-white/10 transition-all duration-500 group relative overflow-hidden" data-aos="fade-up" data-aos-delay="0">
                <div class="w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center mb-6 text-white group-hover:bg-primary group-hover:text-black transition-all duration-500">
                    <?php if(isset($settings['service_1_icon']) && $settings['service_1_icon']): ?>
                        <img src="<?php echo $settings['service_1_icon']; ?>" class="w-6 h-6 object-contain">
                    <?php else: ?>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    <?php endif; ?>
                </div>
                <h4 class="text-xl font-bold font-display text-white mb-3"><?php echo htmlspecialchars($settings['service_1_title'] ?? 'Web Development'); ?></h4>
                <p class="text-text-muted leading-relaxed text-sm">
                    <?php echo htmlspecialchars($settings['service_1_desc'] ?? 'Building fast, responsive, and scalable websites tailored to your needs.'); ?>
                </p>
            </div>
            
            <!-- Service 2 -->
             <div class="p-8 rounded-3xl bg-surface-light/20 border border-white/5 hover:bg-surface-light/30 hover:border-white/10 transition-all duration-500 group relative overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                 <div class="w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center mb-6 text-white group-hover:bg-secondary group-hover:text-white transition-all duration-500">
                    <?php if(isset($settings['service_2_icon']) && $settings['service_2_icon']): ?>
                        <img src="<?php echo $settings['service_2_icon']; ?>" class="w-6 h-6 object-contain">
                    <?php else: ?>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    <?php endif; ?>
                </div>
                <h4 class="text-xl font-bold font-display text-white mb-3"><?php echo htmlspecialchars($settings['service_2_title'] ?? 'App Development'); ?></h4>
                <p class="text-text-muted leading-relaxed text-sm">
                    <?php echo htmlspecialchars($settings['service_2_desc'] ?? 'Creating native and cross-platform mobile applications for iOS and Android.'); ?>
                </p>
            </div>

            <!-- Service 3 -->
             <div class="p-8 rounded-3xl bg-surface-light/20 border border-white/5 hover:bg-surface-light/30 hover:border-white/10 transition-all duration-500 group relative overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                 <div class="w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center mb-6 text-white group-hover:bg-accent group-hover:text-black transition-all duration-500">
                     <?php if(isset($settings['service_3_icon']) && $settings['service_3_icon']): ?>
                        <img src="<?php echo $settings['service_3_icon']; ?>" class="w-6 h-6 object-contain">
                    <?php else: ?>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <?php endif; ?>
                </div>
                <h4 class="text-xl font-bold font-display text-white mb-3"><?php echo htmlspecialchars($settings['service_3_title'] ?? 'UI/UX Design'); ?></h4>
                <p class="text-text-muted leading-relaxed text-sm">
                    <?php echo htmlspecialchars($settings['service_3_desc'] ?? 'Designing intuitive and beautiful user interfaces that users love.'); ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Projects Section (Featured) -->
<section id="projects" class="py-20 md:py-32 relative">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 md:mb-16 gap-4" data-aos="fade-right">
            <div>
                <h2 class="text-sm font-bold text-primary tracking-widest uppercase mb-3">Portfolio</h2>
                <h3 class="text-3xl md:text-5xl font-display font-medium text-white">Selected Works</h3>
            </div>
            <a href="<?php echo BASE_URL; ?>/?page=projects" class="group inline-flex items-center text-text-muted hover:text-white transition-colors font-medium">
                View All Projects 
                <span class="ml-2 group-hover:translate-x-1 transition-transform">→</span>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach($projects as $index => $project): ?>
            <div class="group relative rounded-3xl bg-surface-light/20 border border-white/5 hover:border-white/10 transition-all duration-300 overflow-hidden" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                
                <div class="relative h-64 overflow-hidden">
                    <img class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700" loading="lazy" src="<?php echo $project['image']; ?>" alt="<?php echo htmlspecialchars($project['title']); ?>" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-60 group-hover:opacity-40 transition-opacity"></div>
                </div>
                
                <div class="p-6 md:p-8 relative">
                    <div class="flex flex-wrap gap-2 mb-4">
                        <?php 
                        $tags = $project['tags'];
                        if (is_string($tags)) $tags = explode(',', $tags);
                        elseif (!is_array($tags)) $tags = [];
                        
                        foreach(array_slice($tags, 0, 3) as $tag): 
                        ?>
                            <span class="px-3 py-1 bg-white/5 rounded-full text-gray-300 text-xs font-medium border border-white/5"><?php echo trim($tag); ?></span>
                        <?php endforeach; ?>
                    </div>
                    
                    <h3 class="text-xl font-bold font-display text-white mb-2"><?php echo htmlspecialchars($project['title']); ?></h3>
                    <p class="text-gray-500 text-sm line-clamp-2 leading-relaxed mb-6"><?php echo htmlspecialchars(strip_tags($project['description'])); ?></p>
                    
                    <a href="<?php echo BASE_URL; ?>/?page=detail&slug=<?php echo $project['slug']; ?>" class="inline-flex items-center text-sm font-bold text-white hover:text-primary transition-colors uppercase tracking-wide">
                        Read Case Study
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 md:py-32 relative overflow-hidden text-center">
    <div class="max-w-3xl mx-auto px-4 relative z-10" data-aos="zoom-in">
        <h2 class="text-3xl md:text-5xl font-display font-medium text-white mb-6 md:mb-8">Ready to start your next project?</h2>
        <p class="text-lg md:text-xl text-text-muted mb-8 md:mb-10">Let's collaborate to build scalable and performant digital solutions that drive results.</p>
        <a href="https://wa.me/<?php echo htmlspecialchars($settings['contact_whatsapp'] ?? ''); ?>" class="inline-flex items-center px-8 py-4 text-base font-bold text-black bg-white rounded-full hover:bg-gray-200 transition-all transform hover:-translate-y-1">
            Let's Talk
        </a>
    </div>
</section>
