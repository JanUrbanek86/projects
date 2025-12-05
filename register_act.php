<?php
declare(strict_types=1);

/**
 * Registrace účastníka na erotický veletrh.
 *
 * Připojení k databázi pomocí PDO (host: localhost, uživatel: root, heslo: '', db: cert).
 * Tabulka `participants` by měla mít následující strukturu:
 *
 * CREATE TABLE participants (
 *     id INT AUTO_INCREMENT PRIMARY KEY,
 *     name VARCHAR(255) NOT NULL,
 *     email VARCHAR(255) NOT NULL UNIQUE,
 *     password_hash CHAR(60) NOT NULL,   -- hash z password_hash()
 *     phone VARCHAR(20),
 *     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
 * );
 *
 * V tomto souboru se provádí:
 * 1. Z