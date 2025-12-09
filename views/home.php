<?php
$projects = getProjects(3); // Show top 3 featuring
$settings = getSettings();
?>

<!-- Hero Section -->
<section id="home" class="min-h-screen flex items-center pt-20 relative overflow-hidden bg-dark">
    <!-- Matrix/Grid Effect Background -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-[-10%] right-[-5%] w-[500px] h-[500px] bg-primary rounded-full mix-blend-screen filter blur-[120px] opacity-20 animate-pulse"></div>
        <div class="absolute bottom-[-10%] left-[-5%] w-[500px] h-[500px] bg-secondary rounded-full mix-blend-screen filter blur-[120px] opacity-20"></div>
    </div>

    <div class="max-w-screen-xl mx-auto px-4 z-10 w-full grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="space-y-6" data-aos="fade-right">
            <div class="inline-block px-3 py-1 border border-primary/50 rounded-full bg-primary/10">
                <h2 class="text-xs font-mono font-bold text-primary tracking-widest uppercase">System.Status: Online</h2>
            </div>
            
            <h1 class="text-5xl md:text-7xl font-mono font-bold text-white leading-tight">
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-500">
                    <?php echo htmlspecialchars($settings['hero_title'] ?? 'Create your future'); ?>
                </span>
            </h1>
            
            <div class="font-mono text-gray-400 text-lg border-l-2 border-primary pl-4" data-aos="fade-up" data-aos-delay="200">
                 <?php echo nl2br(htmlspecialchars($settings['hero_subtitle'] ?? 'Showcase your work.')); ?>
                 <span class="animate-pulse">_</span>
            </div>
            
            <div class="flex flex-wrap gap-4 pt-8" data-aos="fade-up" data-aos-delay="400">
                <a href="#projects" class="btn-primary-hover px-8 py-4 font-mono font-bold rounded-none shadow-[5px_5px_0px_rgba(255,255,255,0.2)]">
                    Initialize_Projects()
                </a>
                <a href="https://wa.me/<?php echo htmlspecialchars($settings['contact_whatsapp'] ?? ''); ?>" class="btn-primary-hover px-8 py-4 border border-gray-600 font-mono font-bold rounded-none transition-all">
                    Contact_Me()
                </a>
            </div>
        </div>
        
        <div class="relative hidden lg:block group" data-aos="fade-left" data-aos-delay="200">
            <div class="absolute inset-0 bg-gradient-to-r from-primary to-secondary rounded-lg transform rotate-6 opacity-30 group-hover:opacity-50 transition-opacity blur-lg"></div>
            <!-- Dynamic Hero Image -->
             <?php 
                $heroImage = isset($settings['hero_image']) && !empty($settings['hero_image']) 
                    ? $settings['hero_image'] 
                    : 'https://images.unsplash.com/photo-1544256327-3b959902733d?q=80&w=2000&auto=format&fit=crop';
            ?>
            <div class="relative rounded-lg overflow-hidden border border-gray-700 bg-gray-900/50 p-2">
                <div class="absolute top-0 left-0 w-full h-8 bg-gray-800 flex items-center px-4 gap-2">
                    <div class="w-3 h-3 rounded-full bg-red-500"></div>
                    <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                    <div class="w-3 h-3 rounded-full bg-green-500"></div>
                </div>
                <img src="<?php echo $heroImage; ?>" class="mt-6 rounded border border-gray-800 w-full h-[500px] object-cover grayscale hover:grayscale-0 transition-all duration-700" alt="Profile">
                
                <!-- Code Snippet Overlay -->
                <div class="absolute bottom-6 right-6 p-4 bg-black/80 backdrop-blur border border-primary/30 rounded font-mono text-xs text-green-400" data-aos="zoom-in" data-aos-delay="600">
                    <p>> User.loadProfile()</p>
                    <p>> Loading skills...</p>
                    <p>> DONE <span class="animate-pulse">█</span></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-24 bg-darker relative border-t border-gray-900">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
            <div class="space-y-8" data-aos="fade-right">
                 <h2 class="text-3xl font-mono font-bold text-white">
                    <span class="text-primary">&lt;</span>About_Me<span class="text-primary">/&gt;</span>
                </h2>
                
                <div class="prose prose-invert max-w-none text-gray-400 font-mono leading-relaxed border-l border-gray-800 pl-6">
                    <p class="whitespace-pre-line">
                        <?php echo htmlspecialchars($settings['about_bio'] ?? 'Write your bio here...'); ?>
                    </p>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4">
                    <?php 
                    $defaultFeats = ['Web Development', 'UI/UX Design', 'Mobile Friendly', 'SEO Optimization'];
                    for($i=1; $i<=4; $i++):
                        $text = $settings["about_feat_{$i}_text"] ?? $defaultFeats[$i-1];
                        $iconUrl = $settings["about_feat_{$i}_icon"] ?? null;
                    ?>
                    <div class="flex items-center gap-3 p-4 bg-surface rounded border border-gray-800 hover:border-primary/50 transition-colors group" data-aos="zoom-in" data-aos-delay="<?php echo $i * 100; ?>">
                        <?php if($iconUrl): ?>
                            <img src="<?php echo $iconUrl; ?>" class="w-8 h-8 object-contain opacity-70 group-hover:opacity-100">
                        <?php else: ?>
                            <div class="w-8 h-8 flex items-center justify-center bg-gray-800 rounded text-primary text-xs font-mono">>_</div>
                        <?php endif; ?>
                        <span class="font-mono text-sm text-gray-300 group-hover:text-white transition-colors"><?php echo htmlspecialchars($text); ?></span>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
            
            <div class="bg-surface p-8 rounded border border-gray-800 relative overflow-hidden" data-aos="fade-left">
                <div class="absolute top-0 right-0 p-4 opacity-10">
                    <svg class="w-32 h-32 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M24 10.933v.267c0 .055-.009.102-.016.152l-.007.036c-.006.052-.019.098-.028.148l-.01.033c-.009.052-.023.097-.035.148l-.011.031c-.012.052-.029.096-.044.145l-.014.029c-.015.051-.034.094-.052.143l-.016.027c-.018.05-.04.091-.061.139l-.018.026c-.021.05-.046.089-.07.136l-.021.023c-.024.048-.052.086-.079.131l-.022.023c-.266.443-.654.809-1.127 1.056l-6.861 3.424c-.215.109-.452.164-.69.164-.236 0-.472-.055-.688-.162l-7.069-3.52c-.482-.245-.878-.616-1.146-1.066-.027-.044-.06-.089-.083-.134l-.018-.023c-.023-.046-.051-.089-.071-.137l-.018-.026c-.021-.048-.041-.09-.059-.14l-.016-.027c-.018-.049-.035-.094-.051-.143l-.014-.029c-.015-.049-.03-.094-.043-.146l-.011-.031c-.012-.051-.025-.096-.035-.148l-.01-.033c-.016-.078-.028-.158-.036-.239l-.004-.015c-.004-.042-.01-.084-.01-.128v-.267c0-.236.056-.471.163-.686l3.418-6.946c.108-.216.27-.393.473-.518l-3.924-1.956c-.506-.251-.83-.765-.83-1.328 0-.564.324-1.078.83-1.328l11.029-5.503c.306-.153.655-.153.962 0l11.029 5.503c.505.25.829.764.829 1.328 0 .563-.324 1.077-.829 1.328l-3.928 1.958c.203.125.365.302.473.518l3.417 6.944c.107.215.163.451.163.687zm-11.83-9.525l5.068 2.529-5.068 2.528-5.067-2.528 5.067-2.529zm7.394 3.689l-7.394 3.689-7.394-3.689 3.018-6.136 4.376 2.183c.271.135.597.135.867 0l4.375-2.183 3.152 6.136zm-7.256 9.873l5.069-2.529 1.766 3.59-6.835 3.411-7.042-3.504 1.953-3.527 5.089 2.559z"/></svg>
                </div>
                
                <h4 class="text-xl font-mono font-bold text-white mb-6 relative z-10">Skill_Set_Inventory</h4>
                <div class="grid grid-cols-3 sm:grid-cols-4 gap-6 text-center relative z-10">
                    <?php 
                    $skills = getSkills();
                    foreach($skills as $key => $skill): 
                    ?>
                    <div class="group flex flex-col items-center p-3 rounded hover:bg-white/5 transition-colors cursor-pointer" data-aos="zoom-in" data-aos-delay="<?php echo $key * 50; ?>">
                        <img src="<?php echo $skill['icon_value']; ?>" class="w-12 h-12 mb-3 object-contain grayscale group-hover:grayscale-0 transition-all duration-300 drop-shadow-[0_0_10px_rgba(255,255,255,0.1)]" alt="<?php echo htmlspecialchars($skill['name']); ?>">
                        <span class="text-xs font-mono text-gray-400 group-hover:text-primary"><?php echo htmlspecialchars($skill['name']); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="py-24 bg-dark relative">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-xs font-bold font-mono text-secondary tracking-widest uppercase mb-2">My_Services</h2>
            <h3 class="text-4xl font-mono font-bold text-white">System.Capabilities()</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Service 1 -->
            <div class="p-8 bg-surface border border-gray-800 hover:border-primary/50 transition-all duration-300 group hover:-translate-y-2" data-aos="fade-up" data-aos-delay="0">
                <div class="w-12 h-12 bg-gray-900 rounded border border-gray-700 flex items-center justify-center mb-6 text-primary group-hover:shadow-[0_0_15px_rgba(0,240,255,0.3)] transition-shadow">
                    <?php if(isset($settings['service_1_icon']) && $settings['service_1_icon']): ?>
                        <img src="<?php echo $settings['service_1_icon']; ?>" class="w-6 h-6 object-contain">
                    <?php else: ?>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    <?php endif; ?>
                </div>
                <h4 class="text-xl font-bold font-mono text-white mb-3"><?php echo htmlspecialchars($settings['service_1_title'] ?? 'Web Development'); ?></h4>
                <p class="text-gray-400 leading-relaxed font-mono text-sm">
                    <?php echo htmlspecialchars($settings['service_1_desc'] ?? 'Custom websites...'); ?>
                </p>
            </div>
            
            <!-- Service 2 -->
            <div class="p-8 bg-surface border border-gray-800 hover:border-secondary/50 transition-all duration-300 group hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
                 <div class="w-12 h-12 bg-gray-900 rounded border border-gray-700 flex items-center justify-center mb-6 text-secondary group-hover:shadow-[0_0_15px_rgba(112,0,223,0.3)] transition-shadow">
                    <?php if(isset($settings['service_2_icon']) && $settings['service_2_icon']): ?>
                        <img src="<?php echo $settings['service_2_icon']; ?>" class="w-6 h-6 object-contain">
                    <?php else: ?>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    <?php endif; ?>
                </div>
                <h4 class="text-xl font-bold font-mono text-white mb-3"><?php echo htmlspecialchars($settings['service_2_title'] ?? 'App Development'); ?></h4>
                <p class="text-gray-400 leading-relaxed font-mono text-sm">
                    <?php echo htmlspecialchars($settings['service_2_desc'] ?? 'Mobile apps...'); ?>
                </p>
            </div>

            <!-- Service 3 -->
            <div class="p-8 bg-surface border border-gray-800 hover:border-pink-500/50 transition-all duration-300 group hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
                 <div class="w-12 h-12 bg-gray-900 rounded border border-gray-700 flex items-center justify-center mb-6 text-pink-500 group-hover:shadow-[0_0_15px_rgba(236,72,153,0.3)] transition-shadow">
                     <?php if(isset($settings['service_3_icon']) && $settings['service_3_icon']): ?>
                        <img src="<?php echo $settings['service_3_icon']; ?>" class="w-6 h-6 object-contain">
                    <?php else: ?>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <?php endif; ?>
                </div>
                <h4 class="text-xl font-bold font-mono text-white mb-3"><?php echo htmlspecialchars($settings['service_3_title'] ?? 'UI/UX Design'); ?></h4>
                <p class="text-gray-400 leading-relaxed font-mono text-sm">
                    <?php echo htmlspecialchars($settings['service_3_desc'] ?? 'User-centered design...'); ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Projects Section (Featured) -->
<section id="projects" class="py-24 bg-darker border-t border-gray-900">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-4" data-aos="fade-right">
            <div>
                <h2 class="text-xs font-bold font-mono text-primary tracking-widest uppercase mb-2">Portfolio</h2>
                <h3 class="text-4xl font-mono font-bold text-white">Featured_Deployments</h3>
            </div>
            <a href="<?php echo BASE_URL; ?>/?page=projects" class="inline-flex items-center text-white hover:text-primary transition-colors font-mono border-b border-primary pb-1">
                View_All_Projects() <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach($projects as $index => $project): ?>
            <div class="group relative bg-surface border border-gray-800 hover:border-primary/50 transition-all duration-300 overflow-hidden" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                <!-- Terminal Header -->
                <div class="h-6 bg-gray-900 flex items-center px-2 space-x-1.5 border-b border-gray-700">
                    <div class="w-2.5 h-2.5 rounded-full bg-red-500"></div>
                    <div class="w-2.5 h-2.5 rounded-full bg-yellow-500"></div>
                    <div class="w-2.5 h-2.5 rounded-full bg-green-500"></div>
                </div>
                
                <div class="relative h-64 overflow-hidden">
                    <div class="absolute inset-0 bg-gray-900 animate-pulse"></div>
                    <img class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 relative z-10 grayscale group-hover:grayscale-0" loading="lazy" src="<?php echo $project['image']; ?>" alt="<?php echo htmlspecialchars($project['title']); ?>" />
                    <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20 flex items-center justify-center">
                        <a href="<?php echo BASE_URL; ?>/?page=detail&slug=<?php echo $project['slug']; ?>" class="btn-primary-hover px-6 py-2 border border-primary font-mono transition-colors">
                            > ACCESS_CASE_STUDY
                        </a>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex flex-wrap gap-2 mb-4">
                        <?php 
                        $tags = $project['tags'];
                        if (is_string($tags)) $tags = explode(',', $tags);
                        elseif (!is_array($tags)) $tags = [];
                        
                        foreach(array_slice($tags, 0, 3) as $tag): 
                        ?>
                            <span class="px-2 py-1 bg-gray-900 text-gray-400 text-xs font-mono border border-gray-700"><?php echo trim($tag); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <h3 class="text-xl font-bold font-mono text-white mb-2"><?php echo htmlspecialchars($project['title']); ?></h3>
                    <p class="text-gray-500 text-sm line-clamp-2 font-mono"><?php echo htmlspecialchars(strip_tags($project['description'])); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-24 bg-surface border-t border-gray-800 relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 text-center relative z-10" data-aos="zoom-in">
        <h2 class="text-4xl md:text-5xl font-mono font-bold text-white mb-8">Ready to compile your vision?</h2>
        <p class="text-xl text-gray-400 mb-10 max-w-2xl mx-auto font-mono">Let's collaborate to build scalable and performant digital solutions.</p>
        <a href="https://wa.me/<?php echo htmlspecialchars($settings['contact_whatsapp'] ?? ''); ?>" class="btn-primary-hover inline-flex items-center px-10 py-5 text-lg font-bold font-mono rounded-none shadow-[5px_5px_0px_rgba(255,255,255,0.2)]">
            Start_Collaboration()
        </a>
    </div>
</section>
