<?php
$slug = $_GET['slug'] ?? '';
$project = getProjectBySlug($slug);

if (!$project) {
    echo "<div class='flex flex-col items-center justify-center min-h-[60vh]'>
            <h2 class='text-4xl font-display font-bold mb-4 text-white'>Project Not Found</h2>
            <p class='text-gray-400 mb-8'>The requested project could not be found.</p>
            <a href='" . BASE_URL . "' class='px-6 py-3 bg-primary text-white font-medium rounded-full hover:bg-indigo-600 transition-all'>Return Home</a>
          </div>";
} else {
    $gallery = getProjectGallery($project['id']);
?>

<!-- Hero Banner (Cover Image) -->
<div class="relative w-full h-[60vh] min-h-[500px]">
    <div class="absolute inset-0 bg-gray-900">
         <img src="<?php echo $project['image']; ?>" class="w-full h-full object-cover opacity-80" alt="<?php echo htmlspecialchars($project['title']); ?>">
    </div>
    <div class="absolute inset-0 bg-gradient-to-t from-dark via-dark/60 to-transparent"></div>

    <div class="absolute bottom-0 left-0 w-full p-8 md:p-16">
        <div class="max-w-screen-xl mx-auto">
            <a href="<?php echo BASE_URL; ?>/?page=projects" class="inline-flex items-center text-gray-300 hover:text-white transition-colors mb-6 text-sm font-medium backdrop-blur-md bg-white/5 py-1 px-3 rounded-full border border-white/10">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Projects
            </a>
            
             <div class="flex flex-wrap gap-2 mb-6">
                <?php foreach($project['tags'] as $tag): ?>
                    <span class="bg-primary/20 backdrop-blur-md border border-primary/30 text-white text-xs font-semibold px-3 py-1 rounded-full"><?php echo htmlspecialchars($tag); ?></span>
                <?php endforeach; ?>
            </div>
            <h1 class="text-4xl md:text-6xl font-bold font-display text-white mb-2 leading-tight">
                <?php echo htmlspecialchars($project['title']); ?>
            </h1>
        </div>
    </div>
</div>

<div class="max-w-screen-xl mx-auto px-4 py-16 grid grid-cols-1 lg:grid-cols-3 gap-16">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-12">
        <div class="prose prose-lg max-w-none prose-invert text-gray-400 prose-headings:text-white prose-headings:font-display prose-a:text-primary prose-strong:text-white">
            <h3 class="text-2xl font-bold text-white mb-4">Project Overview</h3>
            <p class="whitespace-pre-line leading-relaxed">
                <?php echo htmlspecialchars($project['description']); ?>
            </p>
        </div>

        <?php if(count($gallery) > 0): ?>
        <div>
            <h3 class="text-2xl font-bold font-display text-white mb-8">Project Gallery</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php foreach($gallery as $img): ?>
                <div class="rounded-2xl overflow-hidden border border-surface-light/30 hover:shadow-2xl hover:shadow-primary/20 transition-all cursor-pointer group relative" onclick="window.open('<?php echo $img['image_path']; ?>', '_blank')">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors z-10 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity transform scale-75 group-hover:scale-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <img src="<?php echo $img['image_path']; ?>" class="w-full h-48 object-cover transform group-hover:scale-105 transition-transform duration-500">
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Sidebar -->
    <div class="space-y-8">
        <div class="bg-surface/50 p-8 rounded-2xl border border-surface-light/30 sticky top-24 backdrop-blur-xl">
            <h3 class="text-xl font-bold font-display text-white mb-6">Project Details</h3>
            
            <div class="space-y-6">
                <div>
                     <span class="block text-xs font-semibold text-gray-500 mb-2 uppercase tracking-wider">Technologies</span>
                     <div class="flex flex-wrap gap-2">
                        <?php foreach($project['tags'] as $tag): ?>
                            <span class="text-xs text-black bg-white px-3 py-1.5 rounded-full font-medium"><?php echo htmlspecialchars($tag); ?></span>
                        <?php endforeach; ?>
                     </div>
                </div>
                
                <?php if(!empty($project['link'])): ?>
                <div class="pt-6 border-t border-surface-light/30">
                    <a href="<?php echo htmlspecialchars($project['link']); ?>" target="_blank" class="flex w-full items-center justify-center px-6 py-4 text-sm font-bold text-white bg-primary rounded-xl hover:bg-indigo-600 transition-all shadow-lg shadow-indigo-500/20 transform hover:-translate-y-1">
                        Visit Live Project <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php } ?>
