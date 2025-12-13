<?php
$projects = getProjects(3); // Show top 3 featuring
$settings = getSettings();
?>

<!-- Hero Section -->
<section id="home" class="min-h-screen flex items-center pt-28 relative overflow-hidden">
    <div class="max-w-screen-xl mx-auto px-4 z-10 w-full grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <div class="space-y-8" data-aos="fade-right">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-surface border border-surface-light/50 backdrop-blur-sm">
                <span class="flex h-2 w-2 relative mr-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                </span>
                <span class="text-sm font-medium text-gray-300">Available for Freelance Work</span>
            </div>
            
            <h1 class="text-5xl md:text-7xl font-display font-bold text-white leading-tight">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-white to-gray-400">
                    <?php echo htmlspecialchars($settings['hero_title'] ?? 'Building digital products that matter.'); ?>
                </span>
            </h1>
            
            <p class="text-lg text-gray-400 leading-relaxed max-w-lg" data-aos="fade-up" data-aos-delay="200">
                 <?php echo nl2br(htmlspecialchars($settings['hero_subtitle'] ?? 'I help brands and businesses create impactful digital experiences through code and design.')); ?>
            </p>
            
            <div class="flex flex-wrap gap-4 pt-4" data-aos="fade-up" data-aos-delay="400">
                <a href="#projects" class="px-8 py-4 bg-white text-black font-bold rounded-full hover:bg-gray-200 transition-all transform hover:-translate-y-1 shadow-lg shadow-white/10">
                    View My Work
                </a>
                <a href="https://wa.me/<?php echo htmlspecialchars($settings['contact_whatsapp'] ?? ''); ?>" class="px-8 py-4 border border-surface-light text-white font-medium rounded-full hover:bg-surface-light/30 transition-all">
                    Contact Me
                </a>
            </div>
        </div>
        
        <div class="relative hidden lg:block" data-aos="fade-left" data-aos-delay="200">
            <!-- Abstract shapes/blobs -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gradient-to-tr from-primary/30 to-secondary/30 rounded-full blur-[100px] -z-10 animate-pulse"></div>
            
             <?php 
                $heroImage = isset($settings['hero_image']) && !empty($settings['hero_image']) 
                    ? $settings['hero_image'] 
                    : 'https://images.unsplash.com/photo-1544256327-3b959902733d?q=80&w=2000&auto=format&fit=crop';
            ?>
            <div class="relative rounded-2xl overflow-hidden border border-surface-light/50 bg-surface/30 backdrop-blur-sm p-4 ring-1 ring-white/10 shadow-2xl transform rotate-3 hover:rotate-0 transition-all duration-700">
                <img src="<?php echo $heroImage; ?>" class="rounded-xl w-full h-[500px] object-cover shadow-inner" alt="Profile">
                
                <!-- Floating Card -->
                <div class="absolute -bottom-6 -left-6 p-6 bg-surface/90 backdrop-blur-xl border border-white/10 rounded-2xl shadow-xl max-w-xs" data-aos="zoom-in" data-aos-delay="600">
                    <div class="flex items-center gap-4 mb-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary to-secondary flex items-center justify-center text-white font-bold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-white">Experience</p>
                            <p class="text-xs text-gray-400">Professional Developer</p>
                        </div>
                    </div>
                    <div class="w-full bg-gray-700 h-1.5 rounded-full overflow-hidden">
                        <div class="bg-primary w-4/5 h-full rounded-full"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-32 relative">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-20 items-center">
            <div class="space-y-8" data-aos="fade-right">
                 <h2 class="text-4xl font-display font-bold text-white">
                    About <span class="text-primary">Me</span>
                </h2>
                
                <div class="prose prose-lg prose-invert text-gray-400 leading-relaxed">
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
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-surface/50 border border-surface-light/30 hover:bg-surface hover:border-primary/30 transition-all group" data-aos="fade-up" data-aos-delay="<?php echo $i * 100; ?>">
                        <?php if($iconUrl): ?>
                            <img src="<?php echo $iconUrl; ?>" class="w-6 h-6 object-contain opacity-70 group-hover:opacity-100">
                        <?php else: ?>
                            <div class="w-8 h-8 flex items-center justify-center bg-primary/10 rounded-lg text-primary text-sm group-hover:scale-110 transition-transform">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                        <?php endif; ?>
                        <span class="font-medium text-gray-300 group-hover:text-white transition-colors"><?php echo htmlspecialchars($text); ?></span>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
            
            <div class="relative" data-aos="fade-left">
                <div class="bg-surface/30 backdrop-blur-md p-8 rounded-3xl border border-surface-light/30">
                    <h3 class="text-xl font-display font-bold text-white mb-6">Technical Skills</h3>
                    <div class="flex flex-wrap gap-3">
                        <?php 
                        $skills = getSkills();
                        foreach($skills as $key => $skill): 
                        ?>
                        <div class="px-4 py-2 bg-surface rounded-lg border border-surface-light/50 flex items-center gap-2 hover:border-primary/50 transition-colors cursor-default" data-aos="zoom-in" data-aos-delay="<?php echo $key * 50; ?>">
                            <img src="<?php echo $skill['icon_value']; ?>" class="w-5 h-5 object-contain" alt="<?php echo htmlspecialchars($skill['name']); ?>">
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
<section id="services" class="py-32 bg-darker/50 border-t border-surface-light/10">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="text-center mb-20" data-aos="fade-up">
            <h2 class="text-sm font-bold text-primary tracking-widest uppercase mb-3">What I Do</h2>
            <h3 class="text-4xl md:text-5xl font-display font-bold text-white">My Services</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Service 1 -->
            <div class="p-8 rounded-2xl bg-surface/40 border border-surface-light/30 hover:bg-surface/60 hover:border-primary/30 transition-all duration-300 group hover:-translate-y-2 relative overflow-hidden" data-aos="fade-up" data-aos-delay="0">
                <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                    <svg class="w-32 h-32 text-primary" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0L24 12L12 24L0 12z"/></svg>
                </div>
                <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center mb-6 text-primary group-hover:scale-110 transition-transform duration-300">
                    <?php if(isset($settings['service_1_icon']) && $settings['service_1_icon']): ?>
                        <img src="<?php echo $settings['service_1_icon']; ?>" class="w-8 h-8 object-contain">
                    <?php else: ?>
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    <?php endif; ?>
                </div>
                <h4 class="text-xl font-bold font-display text-white mb-3"><?php echo htmlspecialchars($settings['service_1_title'] ?? 'Web Development'); ?></h4>
                <p class="text-gray-400 leading-relaxed text-sm">
                    <?php echo htmlspecialchars($settings['service_1_desc'] ?? 'Building fast, responsive, and scalable websites tailored to your needs.'); ?>
                </p>
            </div>
            
            <!-- Service 2 -->
            <div class="p-8 rounded-2xl bg-surface/40 border border-surface-light/30 hover:bg-surface/60 hover:border-secondary/30 transition-all duration-300 group hover:-translate-y-2 relative overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                 <div class="w-14 h-14 bg-secondary/10 rounded-xl flex items-center justify-center mb-6 text-secondary group-hover:scale-110 transition-transform duration-300">
                    <?php if(isset($settings['service_2_icon']) && $settings['service_2_icon']): ?>
                        <img src="<?php echo $settings['service_2_icon']; ?>" class="w-8 h-8 object-contain">
                    <?php else: ?>
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    <?php endif; ?>
                </div>
                <h4 class="text-xl font-bold font-display text-white mb-3"><?php echo htmlspecialchars($settings['service_2_title'] ?? 'App Development'); ?></h4>
                <p class="text-gray-400 leading-relaxed text-sm">
                    <?php echo htmlspecialchars($settings['service_2_desc'] ?? 'Creating native and cross-platform mobile applications for iOS and Android.'); ?>
                </p>
            </div>

            <!-- Service 3 -->
            <div class="p-8 rounded-2xl bg-surface/40 border border-surface-light/30 hover:bg-surface/60 hover:border-pink-500/30 transition-all duration-300 group hover:-translate-y-2 relative overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                 <div class="w-14 h-14 bg-pink-500/10 rounded-xl flex items-center justify-center mb-6 text-pink-500 group-hover:scale-110 transition-transform duration-300">
                     <?php if(isset($settings['service_3_icon']) && $settings['service_3_icon']): ?>
                        <img src="<?php echo $settings['service_3_icon']; ?>" class="w-8 h-8 object-contain">
                    <?php else: ?>
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <?php endif; ?>
                </div>
                <h4 class="text-xl font-bold font-display text-white mb-3"><?php echo htmlspecialchars($settings['service_3_title'] ?? 'UI/UX Design'); ?></h4>
                <p class="text-gray-400 leading-relaxed text-sm">
                    <?php echo htmlspecialchars($settings['service_3_desc'] ?? 'Designing intuitive and beautiful user interfaces that users love.'); ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Projects Section (Featured) -->
<section id="projects" class="py-32 relative">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-4" data-aos="fade-right">
            <div>
                <h2 class="text-sm font-bold text-primary tracking-widest uppercase mb-3">Portfolio</h2>
                <h3 class="text-4xl md:text-5xl font-display font-bold text-white">Featured Work</h3>
            </div>
            <a href="<?php echo BASE_URL; ?>/?page=projects" class="group inline-flex items-center text-gray-400 hover:text-white transition-colors font-medium">
                View All Projects 
                <span class="ml-2 group-hover:translate-x-1 transition-transform">→</span>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach($projects as $index => $project): ?>
            <div class="group relative rounded-2xl bg-surface border border-surface-light/30 hover:border-primary/50 transition-all duration-300 overflow-hidden hover:shadow-2xl hover:shadow-primary/10" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                
                <div class="relative h-64 overflow-hidden">
                    <img class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700" loading="lazy" src="<?php echo $project['image']; ?>" alt="<?php echo htmlspecialchars($project['title']); ?>" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                
                <div class="p-6 relative">
                    <div class="flex flex-wrap gap-2 mb-4">
                        <?php 
                        $tags = $project['tags'];
                        if (is_string($tags)) $tags = explode(',', $tags);
                        elseif (!is_array($tags)) $tags = [];
                        
                        foreach(array_slice($tags, 0, 3) as $tag): 
                        ?>
                            <span class="px-2.5 py-1 bg-surface-light/30 rounded-full text-gray-300 text-xs font-medium border border-white/5"><?php echo trim($tag); ?></span>
                        <?php endforeach; ?>
                    </div>
                    
                    <h3 class="text-xl font-bold font-display text-white mb-2 group-hover:text-primary transition-colors"><?php echo htmlspecialchars($project['title']); ?></h3>
                    <p class="text-gray-500 text-sm line-clamp-2 leading-relaxed mb-4"><?php echo htmlspecialchars(strip_tags($project['description'])); ?></p>
                    
                    <a href="<?php echo BASE_URL; ?>/?page=detail&slug=<?php echo $project['slug']; ?>" class="inline-flex items-center text-sm font-medium text-white hover:text-primary transition-colors">
                        View Case Study <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-32 relative overflow-hidden">
    <!-- Background element -->
    <div class="absolute inset-0 bg-gradient-to-b from-darker to-primary/10"></div>
    <div class="absolute bottom-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-primary/50 to-transparent"></div>
    
    <div class="max-w-4xl mx-auto px-4 text-center relative z-10" data-aos="zoom-in">
        <h2 class="text-4xl md:text-6xl font-display font-bold text-white mb-8 leading-tight">Ready to start your next project?</h2>
        <p class="text-xl text-gray-400 mb-10 max-w-2xl mx-auto">Let's collaborate to build scalable and performant digital solutions that drive results.</p>
        <a href="https://wa.me/<?php echo htmlspecialchars($settings['contact_whatsapp'] ?? ''); ?>" class="inline-flex items-center px-10 py-5 text-lg font-bold text-white bg-primary rounded-full hover:bg-indigo-600 shadow-lg shadow-indigo-500/30 transition-all transform hover:-translate-y-1">
            Let's Talk
        </a>
    </div>
</section>
