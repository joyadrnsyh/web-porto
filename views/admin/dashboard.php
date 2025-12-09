<?php
$projects = getProjects();
$skills = getSkills(); // Just to count
$settings = getSettings();
?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header -->
    <div class="mb-12 flex flex-col sm:flex-row items-center justify-between gap-6">
        <div>
            <h1 class="text-4xl font-mono font-bold text-white mb-2">Command_Center <span class="text-primary animate-pulse">_</span></h1>
            <p class="text-gray-500 font-mono text-sm">System Status: Online | Admin: Active</p>
        </div>
        
        <div class="flex flex-wrap gap-3">
             <a href="<?php echo BASE_URL; ?>/?page=admin_settings" class="btn-primary-hover group flex items-center gap-2 border border-gray-700 px-4 py-2 rounded font-mono text-sm transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Config_Sys
            </a>
            <a href="<?php echo BASE_URL; ?>/?page=admin_skills" class="btn-primary-hover group flex items-center gap-2 border border-gray-700 px-4 py-2 rounded font-mono text-sm transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                Skill_Matrix
            </a>
            <a href="<?php echo BASE_URL; ?>/?page=admin_edit" class="btn-primary-hover flex items-center gap-2 px-6 py-2 rounded font-mono font-bold shadow-[0_0_15px_theme('colors.primary')]">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                New_Project()
            </a>
        </div>
    </div>
    
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="bg-gray-900 border border-gray-800 p-6 rounded-lg relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-5">
                <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <h3 class="text-gray-500 font-mono text-xs uppercase mb-2">Total Deployments</h3>
            <p class="text-4xl font-mono font-bold text-white"><?php echo count($projects); ?></p>
        </div>
        <div class="bg-gray-900 border border-gray-800 p-6 rounded-lg relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-5">
                <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
            </div>
            <h3 class="text-gray-500 font-mono text-xs uppercase mb-2">Modules Installed (Skills)</h3>
            <p class="text-4xl font-mono font-bold text-white"><?php echo count($skills); ?></p>
        </div>
        <div class="bg-gray-900 border border-gray-800 p-6 rounded-lg relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-5">
                 <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <h3 class="text-gray-500 font-mono text-xs uppercase mb-2">Systems Operational</h3>
            <p class="text-4xl font-mono font-bold text-primary">100%</p>
        </div>
    </div>

    <!-- Projects List -->
    <div class="bg-gray-900 border border-gray-800 rounded-lg overflow-hidden">
        <div class="p-6 border-b border-gray-800 flex justify-between items-center">
            <h3 class="text-lg font-mono font-bold text-white">Project_Directory</h3>
            <div class="flex items-center gap-2 text-xs font-mono text-primary">
                <span class="animate-pulse">●</span> LIVE_MONITORING
            </div>
        </div>
        
        <?php if (count($projects) > 0): ?>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-400 font-mono">
                    <thead class="bg-gray-900/50 text-xs uppercase text-gray-500">
                        <tr>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Title</th>
                            <th class="px-6 py-4">Tags</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        <?php foreach ($projects as $project): ?>
                        <tr class="hover:bg-white/5 transition-colors group">
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded bg-green-500/10 text-green-500 text-xs border border-green-500/20">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                    DEPLOYED
                                </span>
                            </td>
                            <td class="px-6 py-4 font-medium text-white group-hover:text-primary transition-colors">
                                <?php echo htmlspecialchars($project['title']); ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php 
                                $tags = $project['tags'];
                                if (is_string($tags)) $tags = explode(',', $tags);
                                elseif (!is_array($tags)) $tags = [];
                                echo implode(', ', array_slice($tags, 0, 3));
                                ?>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="<?php echo BASE_URL; ?>/?page=admin_edit&id=<?php echo $project['id']; ?>" class="text-blue-400 hover:text-white transition-colors">
                                        [EDIT]
                                    </a>
                                    <form method="POST" class="inline-block" onsubmit="return confirm('Confirm deletion of this module?');">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?php echo $project['id']; ?>">
                                        <button type="submit" class="text-red-500 hover:text-red-300 transition-colors">
                                            [DELETE]
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-12">
                <p class="text-gray-500 font-mono">No projects found in registry.</p>
                <a href="<?php echo BASE_URL; ?>/?page=admin_edit" class="text-primary hover:underline mt-2 inline-block">Initialise First Project</a>
            </div>
        <?php endif; ?>
    </div>
</div>
