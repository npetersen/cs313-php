<?php
    
    class Database {
        
        public function dbConnection() {
            
            $dbUrl = getenv('DATABASE_URL');
            $dbopts = parse_url($dbUrl);
            
            $dbHost = $dbopts["host"];
            $dbPort = $dbopts["port"];
            $dbUser = $dbopts["user"];
            $dbPassword = $dbopts["pass"];
            $dbName = ltrim($dbopts["path"],'/');

            try {
                $conn = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
                $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
                return $conn;
            } catch (PDOException $e) {
                echo "Connection error ".$e->getMessage(); 
                exit;
            }
            
        }
    }
    
?>