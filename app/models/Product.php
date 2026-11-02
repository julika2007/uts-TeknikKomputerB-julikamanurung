<?php
class Product
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function all(string $search = ''): array
    {
        $sql = "SELECT p.*, c.name AS category_name
                FROM products p
                LEFT JOIN categories c ON c.id = p.category_id";
        $params = [];
        if ($search !== '') {
            $sql .= " WHERE p.name LIKE ? OR c.name LIKE ?";
            $params = ["%$search%", "%$search%"];
        }
        $sql .= " ORDER BY p.id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function latest(int $limit = 5): array
    {
        $stmt = $this->db->prepare(
            "SELECT p.*, c.name AS category_name
             FROM products p LEFT JOIN categories c ON c.id = p.category_id
             ORDER BY p.id DESC LIMIT ?"
        );
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find(int $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create(array $d): int
    {
        $stmt = $this->db->prepare(
            "INSERT INTO products (name, category_id, price, stock, description)
             VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->execute([$d['name'], $d['category_id'], $d['price'], $d['stock'], $d['description']]);
        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $d): void
    {
        $stmt = $this->db->prepare(
            "UPDATE products
             SET name = ?, category_id = ?, price = ?, stock = ?, description = ?
             WHERE id = ?"
        );
        $stmt->execute([$d['name'], $d['category_id'], $d['price'], $d['stock'], $d['description'], $id]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function stats(): array
    {
        return $this->db->query(
            "SELECT COUNT(*) AS total,
                    COALESCE(SUM(stock), 0) AS total_stock,
                    COALESCE(SUM(stock < 5), 0) AS low_stock
             FROM products"
        )->fetch();
    }
}
