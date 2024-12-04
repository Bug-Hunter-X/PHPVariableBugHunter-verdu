```php
function processData(array $data, array $variables): array {
  foreach ($data as $key => $value) {
    if (is_array($value)) {
      $data[$key] = processData($value, $variables); // Recursive call
    } else if (is_string($value) && str_starts_with($value, "@")) {
      $variableName = substr($value, 1); 
      if (array_key_exists($variableName, $variables)) {
        $data[$key] = $variables[$variableName];
      } else {
        //Handle case where variable is not found, perhaps throw an exception or use a default value
        $data[$key] = null; 
      }
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

$variables = [
  'country' => 'United States'
];

$processedData = processData($data, $variables);
print_r($processedData);
```