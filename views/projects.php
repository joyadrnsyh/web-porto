<?php
$projects = getProjects(); // Get all projects
?>

<div class="pt-24 pb-12 min-h-screen">
    <div class="max-w-screen-xl mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-16 relative">
            <h1 class="text-4xl md:text-6xl font-bold mb-4 font-mono glitch-text text-white" data-text="System.All_Projects">
                System.All_Projects
            </h1>
            <p class="text-primary font-mono text-sm md:text-base typewriter">
                > Initializing case study retrieval... DONE
            </p>
        </div>
        
        <!-- Search/Filter (Visual only for now) -->
        <div class="mb-12 flex justify-center">
            <div class="relative w-full max-w-md">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" class="block w-full pl-10 pr-3 py-3 border border-gray-700 rounded-none bg-black/50 text-gray-300 placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary sm:text-sm font-mono" placeholder="// Search projects...">
            </div>
        </div>

        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach($projects as $project): ?>
            <div class="group relative bg-gray-900 border border-gray-800 hover:border-primary/50 transition-all duration-300 overflow-hidden">
                <!-- Terminal Header -->
                <div class="h-6 bg-gray-800 flex items-center px-2 space-x-1.5 border-b border-gray-700">
                    <div class="w-2.5 h-2.5 rounded-full bg-red-500"></div>
                    <div class="w-2.5 h-2.5 rounded-full bg-yellow-500"></div>
                    <div class="w-2.5 h-2.5 rounded-full bg-green-500"></div>
                </div>
                
                <!-- Image -->
                <div class="relative h-48 overflow-hidden group-hover:opacity-75 transition-opacity">
                    <img class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500" src="<?php echo $project['image']; ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
                    <div class="absolute inset-0 bg-primary/10 mix-blend-overlay"></div>
                </div>

                <div class="p-6">
                    <div class="flex flex-wrap gap-2 mb-4">
                        <?php 
                        $tags = $project['tags'];
                        if (is_string($tags)) $tags = explode(',', $tags);
                        elseif (!is_array($tags)) $tags = [];
                        
                        foreach(array_slice($tags, 0, 3) as $tag): 
                        ?>
                            <span class="px-2 py-1 bg-gray-800 text-primary text-xs font-mono border border-gray-700"><?php echo trim($tag); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <h3 class="text-xl font-bold text-gray-100 mb-2 font-mono group-hover:text-primary transition-colors">
                        <?php echo htmlspecialchars($project['title']); ?>
                    </h3>
                    <p class="text-gray-400 text-sm line-clamp-2 mb-6 font-mono">
                        <?php echo htmlspecialchars(strip_tags($project['description'])); ?>
                    </p>
                    <a href="<?php echo BASE_URL; ?>/?page=detail&slug=<?php echo $project['slug']; ?>" class="inline-flex items-center text-primary hover:text-white font-mono text-sm group-hover:translate-x-1 transition-transform">
                        > View_Source
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
