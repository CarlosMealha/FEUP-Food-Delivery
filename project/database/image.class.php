<?php
  declare(strict_types = 1);

  class Image {
    public int $id_Image;
    public string $type;
    public string $image;
    
    public function __construct(int $id_Image, string $type, string $image)
    {
      $this->id_Image = $id_Image;
      $this->type = $type;
      $this->image = $image;
    }

    static function save_newAddress(PDO $db, string $type, string $image) {
      $stmt = $db->prepare('INSERT INTO Address (type, image) 
                            VALUES (?,?)');

      $stmt->execute(array($type, $image));

    }

    static function save_AddressEdit(PDO $db) {
        $stmt = $db->prepare('UPDATE Address SET type = ?, image = ?
                              WHERE id_Image = ?');
  
        $stmt->execute(array($this->id_Image, $this->type, $this->image));
      }

    static function getAddressFromID(PDO $db, int $id_Image) : Image {
        $stmt = $db->prepare('SELECT id_Image, type, image
                            FROM Address
                            WHERE id_Image = ?');
        $stmt->execute(array($id_Image));
    
        $address = $stmt->fetch();
    
        return new Address(
            (int)$address['id_Image'],
            (string)$address['type'],
            (string)$address['image']
        );
      }  
    }

  
?>