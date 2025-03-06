<?php
if (!defined('ABSPATH')) exit;

class GEM_DB_Schema {
    private static $instance = null;
    private $tables = array();

    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        $this->tables = array(
            'organizations' => array(
                'id' => 'bigint(20) unsigned NOT NULL AUTO_INCREMENT',
                'name' => 'varchar(255) NOT NULL',
                'description' => 'text',
                'contact_email' => 'varchar(255)',
                'contact_phone' => 'varchar(50)',
                'address' => 'text',
                'status' => "enum('active','inactive','pending') DEFAULT 'pending'",
                'created_at' => 'datetime DEFAULT CURRENT_TIMESTAMP',
                'updated_at' => 'datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
            ),
            'students' => array(
                'id' => 'bigint(20) unsigned NOT NULL AUTO_INCREMENT',
                'user_id' => 'bigint(20) unsigned',
                'student_id' => 'varchar(50) UNIQUE',
                'program' => 'varchar(100)',
                'academic_year' => 'int(4)',
                'gpa' => 'decimal(3,2)',
                'status' => "enum('active','inactive','graduated') DEFAULT 'active'",
                'created_at' => 'datetime DEFAULT CURRENT_TIMESTAMP',
                'updated_at' => 'datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
            ),
            'faculty' => array(
                'id' => 'bigint(20) unsigned NOT NULL AUTO_INCREMENT',
                'user_id' => 'bigint(20) unsigned',
                'department' => 'varchar(100)',
                'title' => 'varchar(100)',
                'specialization' => 'text',
                'status' => "enum('active','inactive') DEFAULT 'active'",
                'created_at' => 'datetime DEFAULT CURRENT_TIMESTAMP',
                'updated_at' => 'datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
            ),
            'projects' => array(
                'id' => 'bigint(20) unsigned NOT NULL AUTO_INCREMENT',
                'organization_id' => 'bigint(20) unsigned',
                'title' => 'varchar(255)',
                'description' => 'text',
                'requirements' => 'text',
                'start_date' => 'date',
                'end_date' => 'date',
                'status' => "enum('draft','active','completed','cancelled') DEFAULT 'draft'",
                'created_at' => 'datetime DEFAULT CURRENT_TIMESTAMP',
                'updated_at' => 'datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
            ),
            'matches' => array(
                'id' => 'bigint(20) unsigned NOT NULL AUTO_INCREMENT',
                'student_id' => 'bigint(20) unsigned',
                'project_id' => 'bigint(20) unsigned',
                'faculty_id' => 'bigint(20) unsigned',
                'status' => "enum('pending','approved','rejected','completed') DEFAULT 'pending'",
                'notes' => 'text',
                'created_at' => 'datetime DEFAULT CURRENT_TIMESTAMP',
                'updated_at' => 'datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
            ),
            'documents' => array(
                'id' => 'bigint(20) unsigned NOT NULL AUTO_INCREMENT',
                'user_id' => 'bigint(20) unsigned',
                'type' => "enum('resume','transcript','report','other')",
                'file_path' => 'varchar(255)',
                'status' => "enum('pending','approved','rejected') DEFAULT 'pending'",
                'created_at' => 'datetime DEFAULT CURRENT_TIMESTAMP',
                'updated_at' => 'datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
            ),
            'grades' => array(
                'id' => 'bigint(20) unsigned NOT NULL AUTO_INCREMENT',
                'match_id' => 'bigint(20) unsigned',
                'grader_id' => 'bigint(20) unsigned',
                'grade' => 'decimal(5,2)',
                'feedback' => 'text',
                'created_at' => 'datetime DEFAULT CURRENT_TIMESTAMP',
                'updated_at' => 'datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
            )
        );
    }

    public function create_tables() {
        global $wpdb;
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        foreach ($this->tables as $table_name => $columns) {
            $table = $wpdb->prefix . 'gem_' . $table_name;
            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE IF NOT EXISTS $table (";
            foreach ($columns as $column => $definition) {
                $sql .= "$column $definition,";
            }
            $sql .= "PRIMARY KEY (id)";
            $sql .= ") $charset_collate;";

            dbDelta($sql);
        }
    }

    public function add_foreign_keys() {
        global $wpdb;

        $foreign_keys = array(
            'students' => array(
                'user_id' => array('wp_users', 'ID')
            ),
            'faculty' => array(
                'user_id' => array('wp_users', 'ID')
            ),
            'projects' => array(
                'organization_id' => array('gem_organizations', 'id')
            ),
            'matches' => array(
                'student_id' => array('gem_students', 'id'),
                'project_id' => array('gem_projects', 'id'),
                'faculty_id' => array('gem_faculty', 'id')
            ),
            'documents' => array(
                'user_id' => array('wp_users', 'ID')
            ),
            'grades' => array(
                'match_id' => array('gem_matches', 'id'),
                'grader_id' => array('wp_users', 'ID')
            )
        );

        foreach ($foreign_keys as $table => $keys) {
            $table_name = $wpdb->prefix . 'gem_' . $table;
            foreach ($keys as $column => $reference) {
                $ref_table = $wpdb->prefix . $reference[0];
                $ref_column = $reference[1];
                $wpdb->query("ALTER TABLE $table_name ADD FOREIGN KEY ($column) REFERENCES $ref_table($ref_column)");
            }
        }
    }
}