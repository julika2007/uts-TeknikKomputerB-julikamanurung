<?php
class Category
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function all(): array
    {
        return $this->db->query("SELECT * FROM categories ORDER BY name")->fetchAll();
    }

    public function exists(int $id): bool
    {
        $stmt = $this->db->prepare("SELECT 1 FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        return (bool) $stmt->fetchColumn();
    }

    public function count(): int
    {
        return (int) $this->db->query("SELECT COUNT(*) FROM categories")->fetchColumn();
    }
}
