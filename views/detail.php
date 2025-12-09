<?php
$slug = $_GET['slug'] ?? '';
$project = getProjectBySlug($slug);

if (!$project) {
    echo "<div class='flex flex-col items-center justify-center min-h-[60vh]'>
            <h2 class='text-4xl font-mono font-bold mb-4 text-white'>ERROR_404: Project Not Found</h2>
            <p class='text-gray-500 font-mono mb-6'>The requested resource could not be located in the memory banks.</p>
            <a href='" . BASE_URL . "' class='text-black bg-primary hover:bg-white px-6 py-3 rounded font-bold font-mono transition-all'>Return_Home()</a>
          </div>";
} else {
    $gallery = getProjectGallery($project['id']);
?>

<!-- Hero Banner (Cover Image) -->
<div class="relative w-full h-[60vh] min-h-[500px] border-b border-gray-800">
    <div class="absolute inset-0 bg-gray-900">
         <img src="<?php echo $project['image']; ?>" class="w-full h-full object-cover opacity-60 grayscale hover:grayscale-0 transition-all duration-700">
    </div>
    <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-[#050505]/80 to-transparent"></div>
    <div class="absolute inset-0 bg-grid-pattern bg-grid opacity-[0.2] pointer-events-none"></div>

    <div class="absolute bottom-0 left-0 w-full p-8 md:p-16">
        <div class="max-w-screen-xl mx-auto">
             <div class="flex flex-wrap gap-2 mb-6">
                <?php foreach($project['tags'] as $tag): ?>
                    <span class="bg-gray-900/80 backdrop-blur border border-primary/30 text-primary text-xs font-mono px-3 py-1 rounded"><?php echo htmlspecialchars($tag); ?></span>
                <?php endforeach; ?>
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold font-mono text-white mb-6 leading-tight">
                <span class="text-primary">></span> <?php echo htmlspecialchars($project['title']); ?><span class="animate-pulse">_</span>
            </h1>
            <a href="<?php echo BASE_URL; ?>/?page=projects" class="text-gray-400 hover:text-primary transition-colors flex items-center gap-2 font-mono text-sm">
                &lt; cd ../portfolio
            </a>
        </div>
    </div>
</div>

<div class="max-w-screen-xl mx-auto px-4 py-16 grid grid-cols-1 lg:grid-cols-3 gap-16">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-12">
        <div class="prose prose-lg max-w-none text-gray-400 prose-headings:text-white prose-headings:font-mono prose-a:text-primary prose-strong:text-white font-mono">
            <h3 class="flex items-center gap-2">
                <span class="text-primary">#</span> Mission_Briefing
            </h3>
            <p class="whitespace-pre-line leading-relaxed text-sm md:text-base border-l border-gray-800 pl-4">
                <?php echo htmlspecialchars($project['description']); ?>
            </p>
        </div>

        <?php if(count($gallery) > 0): ?>
        <div>
            <h3 class="text-2xl font-bold font-mono text-white mb-6 flex items-center gap-2">
                 <span class="text-primary">#</span> Visual_Evidence
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <?php foreach($gallery as $img): ?>
                <div class="rounded-lg overflow-hidden border border-gray-800 hover:border-primary/50 transition-all cursor-pointer group bg-gray-900" onclick="window.open('<?php echo $img['image_path']; ?>', '_blank')">
                    <div class="h-6 bg-gray-800 flex items-center px-2 space-x-1.5 border-b border-gray-700">
                        <div class="w-2 h-2 rounded-full bg-red-500"></div>
                        <div class="w-2 h-2 rounded-full bg-yellow-500"></div>
                        <div class="w-2 h-2 rounded-full bg-green-500"></div>
                    </div>
                    <img src="<?php echo $img['image_path']; ?>" class="w-full h-48 object-cover transform group-hover:scale-105 transition-transform duration-500 opacity-80 group-hover:opacity-100">
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Sidebar -->
    <div class="space-y-8">
        <div class="bg-gray-900/50 p-6 rounded border border-gray-800 sticky top-24 backdrop-blur-sm">
            <h3 class="text-lg font-bold font-mono text-white mb-6 border-b border-gray-800 pb-2">MetaData</h3>
            
            <div class="space-y-6 font-mono text-sm">
                <div>
                     <span class="block text-xs text-gray-500 mb-1 uppercase tracking-wider">Classification</span>
                     <span class="block text-white">Portfolio Case Study</span>
                </div>
                <div>
                     <span class="block text-xs text-gray-500 mb-1 uppercase tracking-wider">System Modules</span>
                     <div class="flex flex-wrap gap-2 mt-2">
                        <?php foreach($project['tags'] as $tag): ?>
                            <span class="text-xs text-primary bg-primary/10 px-2 py-1 rounded border border-primary/20"><?php echo htmlspecialchars($tag); ?></span>
                        <?php endforeach; ?>
                     </div>
                </div>
                
                <?php if(!empty($project['link'])): ?>
                <div class="pt-4">
                    <a href="<?php echo htmlspecialchars($project['link']); ?>" target="_blank" class="btn-primary-hover flex w-full items-center justify-center px-6 py-3 text-sm font-bold rounded border border-transparent shadow-[0_0_15px_theme('colors.primary')]">
                        Launch_System() <span class="animate-pulse ml-1">_</span>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php } ?>
