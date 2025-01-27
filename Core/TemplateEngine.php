<?php

namespace Core;

use Exception;

class TemplateEngine {
    protected $templates = [];
    protected $sections = [];
    protected $controller;

    // ارسال شیء کنترلر به قالب
    public function __construct($controller) {
        $this->controller = $controller;
    }

    public function render($template, $data = []) {
        $filePath = BASE_PATH . "/views/{$template}.php"; // مسیر فایل قالب
        $filePath = str_replace("/",  DIRECTORY_SEPARATOR , $filePath);
        if (!file_exists($filePath)) {
            throw new Exception("Template file not found: {$template}");
        }

        // ارسال شیء کنترلر به قالب
        $data['controller'] = $this->controller;

        // استخراج داده‌ها
        extract($data);

        // ذخیره کردن محتوای قالب اصلی
        ob_start();
        include $filePath;
        $content = ob_get_clean();

        // جایگذاری بخش‌ها
        foreach ($this->sections as $name => $value) {
            $content = str_replace("@yield('{$name}')", $value, $content);
        }

        return $content;
    }

    // سایر متدهای extend و section
}
