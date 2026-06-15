# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Development Commands

- **Install dependencies:** `composer install`
- **Setup environment:** `cp .env.example .env && php artisan key:generate`
- **Database migration (MySQL):** `php artisan migrate`
- **Reset database:** `php artisan migrate:fresh`
- **Run server:** `php artisan serve`
- **Lint code:** `vendor/bin/pint`

## High-Level Architecture

This is a Laravel-based Expert System (Sistem Pakar) for laptop diagnosis using **Forward Chaining** and **Certainty Factor** (CF) algorithms.

- **Expert System Logic:** Handled in [ConsultationController.php](app/Http/Controllers/ConsultationController.php).
  - `process()` method implements the CF calculation: `CF Gejala = CF User × CF Pakar`, then combines them using `CF1 + CF2 × (1 - CF1)`.
- **Knowledge Base:**
  - `Gejala` (Symptoms): [Gejala.php](app/Models/Gejala.php)
  - `Kerusakan` (Damages/Diagnosis): [Kerusakan.php](app/Models/Kerusakan.php)
  - `Rule` (Connections): [Rule.php](app/Models/Rule.php) - links symptoms to damages with expert confidence levels (`cf_pakar`).
- **Consultation Process:**
  - User selects symptoms and confidence levels in [consultation/create.blade.php](resources/views/consultation/create.blade.php).
  - Results are stored in `Konsultasi` ([Konsultasi.php](app/Models/Konsultasi.php)) and `DiagnosisResult` ([DiagnosisResult.php](app/Models/DiagnosisResult.php)).
- **Admin Panel:**
  - Controllers for managing symptoms, damages, and rules are located in [app/Http/Controllers/](app/Http/Controllers/).
  - Views for admin dashboard and CRUDs are in [resources/views/admin/](resources/views/admin/).
- **Data Initialization:** Initial knowledge (30 symptoms, 15 damages, rules, and admin account) is populated via migration [2026_06_15_000003_insert_initial_expert_knowledge.php](database/migrations/2026_06_15_000003_insert_initial_expert_knowledge.php) rather than seeders.

## Code Conventions

- **Models:** Use Eloquent relationships defined in the `app/Models/` directory.
- **Controllers:** Keep logic mostly in controllers; calculation logic is currently in `ConsultationController`.
- **Migrations:** Data-heavy migrations are used for the knowledge base.
- **Views:** Blade templates with responsive layouts using [layouts/app.blade.php](resources/views/layouts/app.blade.php) (user) and [layouts/admin.blade.php](resources/views/layouts/admin.blade.php) (admin).
