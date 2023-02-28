<?php

function addImage(string $folder, ?array $item = null, bool $remove = false): bool|string
{
    // On vérifie la taille du fichier
    if ($_FILES['image']['size'] <= 8000000) {
        // On vérifie l'extension du fichier
        $fileInfo = pathinfo($_FILES['image']['name']);
        $extension = $fileInfo['extension'];
        $extensionAllowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

        if (in_array($extension, $extensionAllowed)) {
            // Déplacer le fichier dans le bon dossier
            $imageUploadName = str_replace(' ', '-', $fileInfo['filename']) . (new DateTime())->format('Y-m-d_H:i:s') . '.' . $fileInfo['extension'];

            if ($remove && $item['image']) {
                $imagePath = "/app/uploads/$folder/$item[image]";
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            move_uploaded_file($_FILES['image']['tmp_name'], "/app/uploads/$folder/$imageUploadName");

            return $imageUploadName;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
