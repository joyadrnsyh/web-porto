<?php
// Function to handle single file upload for settings
function uploadSettingImage($fileKey, $prefix = 'setting_') {
    if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === 0) {
        $ext = pathinfo($_FILES[$fileKey]['name'], PATHINFO_EXTENSION);
        $filename = $prefix . uniqid() . '.' . $ext;
        if(move_uploaded_file($_FILES[$fileKey]['tmp_name'], UPLOAD_DIR . $filename)) {
            $path = BASE_URL . '/assets/uploads/' . $filename;
            return str_replace('\\', '/', $path);
        }
    }
    return null;
}
?>
