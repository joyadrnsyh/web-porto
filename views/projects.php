<?php
$projects = getProjects(); // Get all projects
?>

<div class="pt-24 md:pt-32 pb-12 md:pb-20 min-h-screen">
    <div class="max-w-screen-xl mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-12 md:mb-20 relative" data-aos="fade-down">
            <h1 class="text-3xl md:text-4xl lg:text-6xl font-display font-medium text-white mb-4 md:mb-6">
                All Projects
            </h1>
            <p class="text-text-muted text-base md:text-lg max-w-2xl mx-auto font-light">
                A curated collection of my best work, spanning web development, mobile apps, and UI designing.
            </p>
        </div>
        
        <!-- Search/Filter (Visual only for now) -->
        <div class="mb-12 md:mb-16 flex justify-center" data-aos="fade-up" data-aos-delay="100">
            <div class="relative w-full max-w-lg group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-500 group-focus-within:text-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" class="block w-full pl-12 pr-4 py-3 md:py-4 border border-white/5 rounded-full bg-surface-light/30 text-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-primary/50 focus:bg-surface-light/50 transition-all backdrop-blur-sm text-sm md:text-base" placeholder="Search projects...">
            </div>
        </div>

        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            <?php foreach($projects as $index => $project): ?>
            <div class="group relative rounded-3xl bg-surface-light/20 border border-white/5 hover:border-white/10 transition-all duration-300 overflow-hidden" data-aos="fade-up" data-aos-delay="<?php echo $index * 50; ?>">
                
                <!-- Image -->
                <div class="relative h-56 md:h-64 overflow-hidden">
                    <img class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700" loading="lazy" src="<?php echo $project['image']; ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-60 group-hover:opacity-40 transition-opacity"></div>
                </div>

                <div class="p-6 md:p-8">
                    <div class="flex flex-wrap gap-2 mb-4">
                        <?php 
                        $tags = $project['tags'];
                        if (is_string($tags)) $tags = explode(',', $tags);
                        elseif (!is_array($tags)) $tags = [];
                        
                        foreach(array_slice($tags, 0, 3) as $tag): 
                        ?>
                            <span class="px-2.5 md:px-3 py-1 bg-white/5 rounded-full text-gray-300 text-xs font-medium border border-white/5"><?php echo trim($tag); ?></span>
                        <?php endforeach; ?>
                    </div>
                    
                    <h3 class="text-lg md:text-xl font-bold font-display text-white mb-2">
                        <?php echo htmlspecialchars($project['title']); ?>
                    </h3>
                    
                    <p class="text-text-muted text-sm line-clamp-2 mb-6 leading-relaxed">
                        <?php echo htmlspecialchars(strip_tags($project['description'])); ?>
                    </p>
                    
                    <a href="<?php echo BASE_URL; ?>/?page=detail&slug=<?php echo $project['slug']; ?>" class="inline-flex items-center text-sm font-bold text-white hover:text-primary transition-colors uppercase tracking-wide">
                        Read Case Study
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
