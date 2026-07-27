<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\LearningLog;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin / Test User
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        // Sample Categories
        $categoryLaravel = Category::create([
            'name' => 'Laravel',
            'slug' => 'laravel',
        ]);

        $categoryAi = Category::create([
            'name' => 'AI & Antigravity',
            'slug' => 'ai-antigravity',
        ]);

        $categoryFrontend = Category::create([
            'name' => 'Frontend',
            'slug' => 'frontend',
        ]);

        // Sample Projects
        Project::create([
            'category_id' => $categoryLaravel->id,
            'title' => 'Personal Portfolio & DevLog',
            'slug' => 'personal-portfolio-devlog',
            'description' => 'A full-stack portfolio web application built with Laravel 12, Blade, Tailwind CSS, Alpine.js, and MySQL. Optimized for shared hosting (InfinityFree).',
            'image' => null,
            'tech_stack' => 'Laravel 12, PHP 8.3, Tailwind CSS, Alpine.js, MySQL',
            'github_url' => 'https://github.com/Isnaini212/portfolio-app',
            'demo_url' => 'https://example.com',
            'is_featured' => true,
        ]);

        Project::create([
            'category_id' => $categoryAi->id,
            'title' => 'AI Code Assistant Integrations',
            'slug' => 'ai-code-assistant-integrations',
            'description' => 'Custom agents and workflow scripts using DeepMind Antigravity framework for pair programming and automated verification.',
            'image' => null,
            'tech_stack' => 'Python, Gemini API, Markdown Tools',
            'github_url' => 'https://github.com/example/ai-assistant',
            'demo_url' => null,
            'is_featured' => true,
        ]);

        Project::create([
            'category_id' => $categoryFrontend->id,
            'title' => 'Interactive Dashboard Components',
            'slug' => 'interactive-dashboard-components',
            'description' => 'A library of lightweight Alpine.js and Tailwind CSS UI components designed for dynamic web applications.',
            'image' => null,
            'tech_stack' => 'Alpine.js, Tailwind CSS, HTML5',
            'github_url' => 'https://github.com/example/dashboard-ui',
            'demo_url' => 'https://example.com/demo-dashboard',
            'is_featured' => false,
        ]);

        // Sample Learning Logs
        LearningLog::create([
            'category_id' => $categoryLaravel->id,
            'title' => 'Mastering Laravel Blade & Alpine.js Communication',
            'slug' => 'mastering-laravel-blade-alpinejs-communication',
            'content' => 'Explored seamless data binding between Blade templates and Alpine.js component scope without relying on heavy frontend frameworks.',
            'status' => 'completed',
            'learned_at' => '2026-07-20',
        ]);

        LearningLog::create([
            'category_id' => $categoryLaravel->id,
            'title' => 'Optimizing Laravel Deployment for Shared Hosting',
            'slug' => 'optimizing-laravel-deployment-shared-hosting',
            'content' => 'Investigating strategies for running Laravel apps on hostings without SSH/Composer access such as InfinityFree.',
            'status' => 'in_progress',
            'learned_at' => '2026-07-25',
        ]);

        LearningLog::create([
            'category_id' => $categoryAi->id,
            'title' => 'Prompt Engineering & Agentic Workflow Design',
            'slug' => 'prompt-engineering-agentic-workflow-design',
            'content' => 'Studied best practices for tool execution safety, context management, and iterative planning in autonomous AI coding assistants.',
            'status' => 'completed',
            'learned_at' => '2026-07-22',
        ]);

        LearningLog::create([
            'category_id' => $categoryFrontend->id,
            'title' => 'Modern Styling with Tailwind CSS v4',
            'slug' => 'modern-styling-with-tailwind-css-v4',
            'content' => 'Planning to explore Tailwind CSS v4 features, Vite integration, and performance benchmarks.',
            'status' => 'planning',
            'learned_at' => '2026-07-27',
        ]);
    }
}
