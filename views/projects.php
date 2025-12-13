<?php
$projects = getProjects(); // Get all projects
?>

<div class="pt-32 pb-20 min-h-screen">
    <div class="max-w-screen-xl mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-20 relative" data-aos="fade-down">
            <h1 class="text-4xl md:text-6xl font-display font-bold text-white mb-6">
                All Projects
            </h1>
            <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                A curated collection of my best work, spanning web development, mobile apps, and UI designing.
            </p>
        </div>
        
        <!-- Search/Filter (Visual only for now) -->
        <div class="mb-16 flex justify-center" data-aos="fade-up" data-aos-delay="100">
            <div class="relative w-full max-w-lg group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-500 group-focus-within:text-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" class="block w-full pl-12 pr-4 py-4 border border-surface-light/30 rounded-full bg-surface/50 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:bg-surface transition-all shadow-lg" placeholder="Search projects...">
            </div>
        </div>

        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach($projects as $index => $project): ?>
            <div class="group relative rounded-2xl bg-surface border border-surface-light/30 hover:border-primary/50 transition-all duration-300 overflow-hidden hover:shadow-2xl hover:shadow-primary/10" data-aos="fade-up" data-aos-delay="<?php echo $index * 50; ?>">
                
                <!-- Image -->
                <div class="relative h-64 overflow-hidden">
                    <img class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700" loading="lazy" src="<?php echo $project['image']; ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>

                <div class="p-6">
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
                    
                    <h3 class="text-xl font-bold font-display text-white mb-2 group-hover:text-primary transition-colors">
                        <?php echo htmlspecialchars($project['title']); ?>
                    </h3>
                    
                    <p class="text-gray-400 text-sm line-clamp-2 mb-6 leading-relaxed">
                        <?php echo htmlspecialchars(strip_tags($project['description'])); ?>
                    </p>
                    
                    <a href="<?php echo BASE_URL; ?>/?page=detail&slug=<?php echo $project['slug']; ?>" class="inline-flex items-center text-sm font-medium text-white hover:text-primary transition-colors">
                        View Case Study <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
