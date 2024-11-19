<?php

class DatabaseHandler {
    private $connection;

    public function __construct($connection) {
        $this->connection=$connection;

        // Check connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    // Insert data into a specified table
    public function insert($table, $data) {
        // Check for null values in required fields
        if (in_array(null, $data, true)) {
            foreach ($data as $key => $value) {
                if ($value === null) {
                    echo "Error: The field '$key' cannot be null.<br>";
                }
            }
            return false;
        }
    
        // Prepare columns and placeholders as before
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), '?'));
    
        // Prepare the statement
        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        if ($stmt = $this->connection->prepare($query)) {
            $types = str_repeat('s', count($data));
            $stmt->bind_param($types, ...array_values($data));
            if ($stmt->execute()) {
                return $this->connection->insert_id;
            } else {
                echo "Execution Error: " . $stmt->error;
                return false;
            }
        } else {
            echo "Preparation Error: " . $this->connection->error;
            return false;
        }
    }
    

    // Fetch all records from a specified table
    public function fetchAll($table) {
        $query = "SELECT * FROM $table";
        $result = $this->connection->query($query);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function fetchSumAndCount($table, $column) {
        // Construct the SQL query to get the sum and count of the specified column
        $query = "SELECT SUM($column) AS total_sum, COUNT($column) AS total_count FROM $table";
        $result = $this->connection->query($query);
    
        // Check if there are results and return them in an associative array format
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc(); // Returns an array with 'total_sum' and 'total_count'
        } else {
            return ['total_sum' => 0, 'total_count' => 0]; // Return 0 values if no results found
        }
    }
    

    public function fetchAllOnRole($table,$role) {
        $query = "SELECT * FROM $table where Role='$role'";
        $result = $this->connection->query($query);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    // Update records in a specified table based on conditions
    public function update($table, $data, $where) {
        $setValues = [];
        foreach ($data as $column => $value) {
            // Ensure that the values are properly escaped to prevent SQL injection
            $setValues[] = "$column = '$value'";
        }
        $setString = implode(", ", $setValues);
    
        // Build the WHERE clause
        $whereConditions = [];
        foreach ($where as $column => $value) {
            $whereConditions[] = "$column = '$value'";
        }
        $whereString = implode(" AND ", $whereConditions);
    
        // Construct the SQL query
        $query = "UPDATE $table SET $setString WHERE $whereString";
    
        // Execute the query
        return $this->connection->query($query);
    }
    

    // Delete records from a specified table based on conditions
    public function delete($table, $where) {
        // Build the WHERE condition from the $where array
        $whereConditions = [];
        $params = [];
        foreach ($where as $column => $value) {
            $whereConditions[] = "$column = ?";
            $params[] = $value;
        }
        $whereString = implode(" AND ", $whereConditions);
    
        // Prepare the DELETE query
        $query = "DELETE FROM $table WHERE $whereString";
    
        // Prepare and execute the query with parameter binding
        if ($stmt = $this->connection->prepare($query)) {
            $types = str_repeat('s', count($params)); // Assuming all parameters are strings
            $stmt->bind_param($types, ...$params);
            return $stmt->execute();
        }
    
        return false;
    }
    

    // Close the database connection
    public function __destruct() {
        $this->connection->close();
    }
}
