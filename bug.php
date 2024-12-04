```php
function processData(array $data): array {
  foreach ($data as $key => $value) {
    if (is_array($value)) {
      $data[$key] = processData($value); // Recursive call
    } else if (is_string($value) && str_starts_with($value, "@")) {
      //Attempting to access a dynamically named variable
      $data[$key] = $$value; 
    }
  }
  return $data;
}

$data = [
  'name' => 'John Doe',
  'age' => 30,
  'address' => ['city' => 'New York', '@country' => 'USA'],
  '@country' => 'USA'
];

$country = 'United States';
$processedData = processData($data);
print_r($processedData);
```