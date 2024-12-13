<?php
/**
 * generator-form.php - Restaurant Chain Generator Form
 */

use Helpers\RandomGenerator;

// デフォルト設定を取得
$defaultConfig = RandomGenerator::getDefaultConfig();
?>
<div class="generator-container">
    <h2>Restaurant Chain Generator</h2>
    <form action="index.php" method="GET" class="generator-form">
        <input type="hidden" name="action" value="generate">
        
        <div class="form-section">
            <h3>Employee Settings</h3>
            <div class="form-group">
                <label for="minEmployees">Minimum Employees per Location:</label>
                <input type="number" 
                       id="minEmployees" 
                       name="minEmployees" 
                       min="1" 
                       max="50" 
                       value="<?php echo $defaultConfig['employeeMinCount']; ?>">
            </div>
            <div class="form-group">
                <label for="maxEmployees">Maximum Employees per Location:</label>
                <input type="number" 
                       id="maxEmployees" 
                       name="maxEmployees" 
                       min="1" 
                       max="50" 
                       value="<?php echo $defaultConfig['employeeMaxCount']; ?>">
            </div>
        </div>

        <div class="form-section">
            <h3>Salary Range</h3>
            <div class="form-group">
                <label for="minSalary">Minimum Salary:</label>
                <input type="number" 
                       id="minSalary" 
                       name="minSalary" 
                       min="20000" 
                       max="200000" 
                       step="1000" 
                       value="<?php echo $defaultConfig['salaryMin']; ?>">
            </div>
            <div class="form-group">
                <label for="maxSalary">Maximum Salary:</label>
                <input type="number" 
                       id="maxSalary" 
                       name="maxSalary" 
                       min="20000" 
                       max="200000" 
                       step="1000" 
                       value="<?php echo $defaultConfig['salaryMax']; ?>">
            </div>
        </div>

        <div class="form-section">
            <h3>Location Settings</h3>
            <div class="form-group">
                <label for="locationCount">Number of Locations:</label>
                <input type="number" 
                       id="locationCount" 
                       name="locationCount" 
                       min="1" 
                       max="20" 
                       value="<?php echo $defaultConfig['locationCount']; ?>">
            </div>
            <div class="form-group">
                <label for="minZipCode">Minimum ZIP Code:</label>
                <input type="text" 
                       id="minZipCode" 
                       name="minZipCode" 
                       pattern="\d{5}" 
                       placeholder="00000" 
                       value="<?php echo $defaultConfig['zipCodeMin']; ?>">
            </div>
            <div class="form-group">
                <label for="maxZipCode">Maximum ZIP Code:</label>
                <input type="text" 
                       id="maxZipCode" 
                       name="maxZipCode" 
                       pattern="\d{5}" 
                       placeholder="99999" 
                       value="<?php echo $defaultConfig['zipCodeMax']; ?>">
            </div>
        </div>

        <div class="form-section">
            <h3>Output Format</h3>
            <div class="form-group format-options">
                <label>
                    <input type="radio" name="format" value="html" checked>
                    HTML
                </label>
                <label>
                    <input type="radio" name="format" value="json">
                    JSON
                </label>
                <label>
                    <input type="radio" name="format" value="markdown">
                    Markdown
                </label>
                <label>
                    <input type="radio" name="format" value="txt">
                    Text
                </label>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Generate Chain</button>
            </br>
            </br>
            <button type="reset" class="btn btn-secondary" onclick="resetToDefaults()">Reset to Defaults</button>
        </div>
    </form>
</div>

<script>
// リセットボタンがクリックされたときにデフォルト値に戻す
function resetToDefaults() {
    // デフォルト値をJavaScriptオブジェクトとして定義
    const defaults = {
        minEmployees: <?php echo $defaultConfig['employeeMinCount']; ?>,
        maxEmployees: <?php echo $defaultConfig['employeeMaxCount']; ?>,
        minSalary: <?php echo $defaultConfig['salaryMin']; ?>,
        maxSalary: <?php echo $defaultConfig['salaryMax']; ?>,
        locationCount: <?php echo $defaultConfig['locationCount']; ?>,
        minZipCode: '<?php echo $defaultConfig['zipCodeMin']; ?>',
        maxZipCode: '<?php echo $defaultConfig['zipCodeMax']; ?>'
    };

    // 各フィールドをデフォルト値に設定
    for (const [id, value] of Object.entries(defaults)) {
        document.getElementById(id).value = value;
    }

    // HTMLラジオボタンを選択
    document.querySelector('input[value="html"]').checked = true;
}
</script>