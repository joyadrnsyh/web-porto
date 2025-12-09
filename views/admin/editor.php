<?php
$project = null;
if (isset($_GET['id'])) {
    $project = getProjectById($_GET['id']);
    if (!$project) {
        setFlash('error', 'Project not found.');
        header('Location: ' . BASE_URL . '/?page=admin');
        exit;
    }
}

// Handle Form Submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_gallery_image'])) {
        // Handle Gallery Image Deletion
        header('Content-Type: application/json');
        deleteGalleryImage($_POST['image_id']);
        echo json_encode(['success' => true]);
        exit;
    }

    $id = $_POST['id'] ?? null;
    $title = $_POST['title'];
    $description = $_POST['description'];
    $currentImage = $_POST['current_image'] ?? '';
    
    // Check main image upload
    $imagePath = $currentImage;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = 'cover_' . uniqid() . '.' . $ext;
        if(move_uploaded_file($_FILES['image']['tmp_name'], UPLOAD_DIR . $filename)) {
            $imagePath = BASE_URL . '/assets/uploads/' . $filename;
            $imagePath = str_replace('\\', '/', $imagePath);
        }
    }
    
    $tags = $_POST['tags'];
    // Handle tags if they are array or string
    if(is_array($tags)) {
        $tags = implode(',', $tags);
    }
    
    $projectId = saveProject($title, $description, $imagePath, $tags, $id);

    // Handle Gallery Uploads
    if (isset($_FILES['gallery']) && !empty($_FILES['gallery']['name'][0])) {
        $total = count($_FILES['gallery']['name']);
        for ($i = 0; $i < $total; $i++) {
            if ($_FILES['gallery']['error'][$i] === 0) {
                $ext = pathinfo($_FILES['gallery']['name'][$i], PATHINFO_EXTENSION);
                $filename = 'gallery_' . uniqid() . '_' . $i . '.' . $ext;
                if(move_uploaded_file($_FILES['gallery']['tmp_name'][$i], UPLOAD_DIR . $filename)) {
                    $galleryPath = BASE_URL . '/assets/uploads/' . $filename;
                    $galleryPath = str_replace('\\', '/', $galleryPath);
                    addGalleryImage($projectId, $galleryPath);
                }
            }
        }
    }

    // Ajax response
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'redirect' => BASE_URL . '/?page=admin']);
    exit;
}

$galleryImages = $project ? getProjectGallery($_GET['id']) : [];
?>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="max-w-4xl mx-auto px-4 py-12">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-mono font-bold text-white"><?php echo $project ? 'Edit_Protocol' : 'New_Protocol'; ?></h1>
            <p class="text-gray-500 mt-1 font-mono text-xs">Configure project parameters.</p>
        </div>
        <a href="<?php echo BASE_URL; ?>/?page=admin" class="text-gray-400 hover:text-white px-4 py-2 border border-gray-700 hover:border-white rounded transition-colors font-mono text-sm">
            < Cancel_Op
        </a>
    </div>

    <form id="projectForm" class="bg-gray-900 border border-gray-800 rounded-lg p-8 shadow-lg" enctype="multipart/form-data">
        <?php if($project): ?>
            <input type="hidden" name="id" value="<?php echo $project['id']; ?>">
            <input type="hidden" name="current_image" value="<?php echo $project['image']; ?>">
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div class="space-y-6">
                <!-- Title -->
                <div>
                    <label class="block text-primary font-mono text-xs mb-2 uppercase">Project Title</label>
                    <input type="text" name="title" value="<?php echo htmlspecialchars($project['title'] ?? ''); ?>" required class="w-full bg-black border border-gray-700 text-white rounded p-3 focus:border-primary focus:ring-1 focus:ring-primary outline-none font-mono placeholder-gray-600">
                </div>

                <!-- Tags -->
                <div>
                    <label class="block text-primary font-mono text-xs mb-2 uppercase">Tech Stack (comma separated)</label>
                    <input type="text" name="tags" value="<?php echo htmlspecialchars($project['tags'] ?? ''); ?>" placeholder="PHP, Laravel, Tailwind" class="w-full bg-black border border-gray-700 text-white rounded p-3 focus:border-primary focus:ring-1 focus:ring-primary outline-none font-mono placeholder-gray-600">
                </div>
                
                <!-- Description -->
                <div>
                    <label class="block text-primary font-mono text-xs mb-2 uppercase">Description</label>
                    <textarea name="description" rows="6" required class="w-full bg-black border border-gray-700 text-white rounded p-3 focus:border-primary focus:ring-1 focus:ring-primary outline-none font-mono placeholder-gray-600"><?php echo htmlspecialchars($project['description'] ?? ''); ?></textarea>
                </div>
            </div>

            <div class="space-y-6">
                <!-- Cover Image -->
                <div>
                    <label class="block text-primary font-mono text-xs mb-2 uppercase">Cover Image</label>
                    <div class="bg-black border-2 border-dashed border-gray-700 rounded-lg p-6 text-center hover:border-primary/50 transition-colors relative group">
                        <input type="file" name="image" id="coverDetail" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="previewCover(this)">
                        
                        <div id="coverPreviewContainer" class="<?php echo $project ? '' : 'hidden'; ?>">
                            <img id="coverPreview" src="<?php echo $project['image'] ?? ''; ?>" class="max-h-48 mx-auto rounded shadow-lg object-contain">
                            <p class="text-xs text-gray-500 mt-2 font-mono">Click to replace</p>
                        </div>
                        
                        <div id="coverPlaceholder" class="<?php echo $project ? 'hidden' : ''; ?>">
                            <svg class="mx-auto h-12 w-12 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                             <p class="mt-1 text-xs text-gray-500 font-mono">Upload Cover</p>
                        </div>
                    </div>
                </div>

                <!-- Gallery -->
                <div>
                    <label class="block text-primary font-mono text-xs mb-2 uppercase">Gallery Images</label>
                    <div class="bg-black border border-gray-700 rounded p-4">
                        <input type="file" name="gallery[]" multiple accept="image/*" class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-primary file:text-black hover:file:bg-white transition-colors mb-4">
                        
                        <?php if(!empty($galleryImages)): ?>
                        <div class="grid grid-cols-3 gap-2">
                             <?php foreach($galleryImages as $img): ?>
                                <div class="relative group" id="gallery-item-<?php echo $img['id']; ?>">
                                    <img src="<?php echo $img['image_path']; ?>" class="h-20 w-full object-cover rounded border border-gray-600">
                                    <button type="button" onclick="deleteGallery(<?php echo $img['id']; ?>)" class="absolute top-0 right-0 bg-red-500 text-white p-1 rounded-bl text-xs opacity-0 group-hover:opacity-100 transition-opacity">
                                        ×
                                    </button>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" id="saveBtn" class="btn-primary-hover w-full py-4 font-bold font-mono rounded transition-colors flex items-center justify-center gap-2 shadow-[0_0_15px_theme('colors.primary')]">
            <span id="btnText">EXECUTE_SAVE()</span>
            <div id="spinner" class="hidden animate-spin rounded-full h-5 w-5 border-b-2 border-black"></div>
        </button>
    </form>
</div>

<script>
function previewCover(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('coverPreview').src = e.target.result;
            document.getElementById('coverPreviewContainer').classList.remove('hidden');
            document.getElementById('coverPlaceholder').classList.add('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function deleteGallery(id) {
    Swal.fire({
        title: 'Delete Image?',
        text: "This cannot be undone.",
        icon: 'warning',
        background: '#111',
        color: '#fff',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = new FormData();
            formData.append('delete_gallery_image', true);
            formData.append('image_id', id);

            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    document.getElementById('gallery-item-' + id).remove();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#111',
                        color: '#fff',
                        timerProgressBar: true,
                    });
                    Toast.fire({
                        icon: 'success',
                        title: 'Image deleted'
                    });
                }
            });
        }
    })
}

document.getElementById('projectForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const btn = document.getElementById('saveBtn');
    const spinner = document.getElementById('spinner');
    const text = document.getElementById('btnText');
    
    // UI Loading
    btn.disabled = true;
    text.textContent = 'PROCESSING...';
    spinner.classList.remove('hidden');
    
    const formData = new FormData(this);

    fetch('', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                title: 'Success!',
                text: 'Project saved successfully.',
                icon: 'success',
                background: '#111',
                color: '#fff',
                confirmButtonColor: '#00f0ff',
                confirmButtonText: '<span style="color:black">OK</span>'
            }).then(() => {
                 window.location.href = data.redirect;
            });
        } else {
            Swal.fire({
                title: 'Error!',
                text: 'Something went wrong.',
                icon: 'error',
                background: '#111',
                color: '#fff'
            });
             // Reset UI
            btn.disabled = false;
            text.textContent = 'EXECUTE_SAVE()';
            spinner.classList.add('hidden');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
             title: 'Error!',
             text: 'Network or Server Error',
             icon: 'error',
             background: '#111',
             color: '#fff'
        });
        // Reset UI
        btn.disabled = false;
        text.textContent = 'EXECUTE_SAVE()';
        spinner.classList.add('hidden');
    });
});
</script>
