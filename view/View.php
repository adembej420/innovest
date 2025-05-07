<?php
namespace App\View;

class View {
    private static $layoutIncluded = false;
    private static $includedTemplates = [];
    private static $content = '';
    private $layoutPath;
    private $basePath = '/userv2/gestion_user';
    private $layout = null;

    public function __construct() {
        // Set default layout path based on user role
        $this->layoutPath = isset($_SESSION['role']) && $_SESSION['role'] === 'admin'
            ? __DIR__ . '/back-office/layout.php'
            : __DIR__ . '/front-office/layout.php';
    }

    /**
     * Set a custom layout
     * @param string $layout The layout name ('admin', 'user', or null for default)
     */
    public function setLayout($layout) {
        $this->layout = $layout;

        if ($layout === 'admin') {
            $this->layoutPath = __DIR__ . '/back-office/layout.php';
        } elseif ($layout === 'user') {
            $this->layoutPath = __DIR__ . '/front-office/user_layout.php';
        }
    }

    /**
     * Reset the static properties to prevent duplication
     */
    public static function reset() {
        self::$layoutIncluded = false;
        self::$includedTemplates = [];
        self::$content = '';
    }

    public function display($template, $data = []) {
        // Extract data to make variables available in template
        extract($data);

        // If content is already provided, use it directly
        if (isset($data['content'])) {
            self::$content = $data['content'];
        } else {
            // Start output buffering
            ob_start();

            // Determine the template path based on layout or role
            $folder = 'front-office/';
            if ($this->layout === 'admin' || (isset($_SESSION['role']) && $_SESSION['role'] === 'admin' && $this->layout !== 'user')) {
                $folder = 'back-office/';
            }

            $templatePath = __DIR__ . '/' . $folder . $template;

            if (!in_array($templatePath, self::$includedTemplates)) {
                self::$includedTemplates[] = $templatePath;
                include $templatePath;
            }

            // Get the content
            self::$content = ob_get_clean();
        }

        // Include layout only if not already included
        if (!self::$layoutIncluded) {
            self::$layoutIncluded = true;
            include $this->layoutPath;
        } else {
            echo self::$content;
        }
    }

    public static function getContent() {
        return self::$content;
    }

    public function getAssetPath($path) {
        return $this->basePath . $path;
    }
}
