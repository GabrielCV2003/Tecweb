<?php
namespace MyApi;

require_once 'DataBase.php';

class Products extends DataBase {
    private $response = [];

    public function __construct(string $db = 'marketzone', string $user = 'root', string $pass = 'vallelly2003') {
        parent::__construct($db, $user, $pass);
    }

    public function add(object $product): void {
        $sql = "INSERT INTO products (name, price, description) VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("sss", $product->name, $product->price, $product->description);
        $stmt->execute();
        $this->response[] = $stmt->affected_rows > 0 ? "Producto agregado" : "Error al agregar";
        $stmt->close();
    }

    public function delete(string $id): void {
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $this->response[] = $stmt->affected_rows > 0 ? "Producto eliminado" : "Error al eliminar";
        $stmt->close();
    }

    public function edit(object $product): void {
        $sql = "UPDATE products SET name = ?, price = ?, description = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("sssi", $product->name, $product->price, $product->description, $product->id);
        $stmt->execute();
        $this->response[] = $stmt->affected_rows > 0 ? "Producto actualizado" : "Error al actualizar";
        $stmt->close();
    }

    public function list(): void {
        $sql = "SELECT * FROM products";
        $result = $this->conexion->query($sql);
        $this->response = $result->fetch_all(MYSQLI_ASSOC);
    }

    public function search(string $id): void {
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $this->response = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    }

    public function single(string $id): void {
        $this->search($id);
    }

    public function singleByName(string $name): void {
        $sql = "SELECT * FROM products WHERE name = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $this->response = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    }

    public function getData(): string {
        return json_encode($this->response, JSON_PRETTY_PRINT);
    }
}
?>
