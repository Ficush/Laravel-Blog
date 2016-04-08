<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class System extends Model {

	protected $table = 'System';
    protected $fillable = ['key', 'value', 'type', 'description'];

    public static function getConfig($key)
    {
        $config = System::where('key', $key) -> first();
        if (empty($config)) return false;
        $value  = $config -> value;
        $type   = $config -> type;
        switch ($type)
        {
            case 'string' : return $value; break;
            case 'int'    : return intval($value); break;
            case 'boolean': return (bool) intval($value); break;
            case 'float'  : return floatval($value); break;
            default       : return $value; 
        }
    }

    public static function setConfig($key, $value, $type = null, $name = null, $description = null)
    {
        $config = System::where('key', $key);
        if (empty($config)) return false;
        $data = ['value' => $value];
        if ($type) $data['type'] = $type;
        if ($name) $data['name'] = $name;
        if ($description) $data['description'] = $description;
        $config->update($data);
        return true;
    }

    public static function createConfig($key, $value, $type = 'string', $name = '', $description = '')
    {
        if (!empty(System::where('key', $key))) return false;
        $data = [
            'key'         => $key,
            'value'       => $value,
            'type'        => $type,
            'name'        => $name,
            'description' => $description,
        ];
        System::create($data);
        return true;
    }

    public static function deleteConfig($key)
    {
        $config = System::where('key', $key);
        if (empty($config)) return false;
        $config -> delete();
        return true;
    }

}
