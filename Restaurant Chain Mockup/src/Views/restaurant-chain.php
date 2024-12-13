<?php
/**
 * restaurant-chain.php - レストランチェーンの詳細表示テンプレート
 * 
 * このファイルはレストランチェーンの情報を表示する専用のビューです。
 * RestaurantChain オブジェクトを受け取り、その情報を構造化されたHTMLで表示します。
 * 
 * @var RestaurantChain $chain レストランチェーンオブジェクト
 */
?>
<div class="restaurant-chain-container">
    <?php if (isset($chain)): ?>
        <!-- チェーン概要セクション -->
        <section class="chain-overview">
            <div class="chain-header">
                <h2><?php echo htmlspecialchars($chain->getName()); ?></h2>
                <div class="chain-meta">
                    <span class="cuisine-type"><?php echo htmlspecialchars($chain->getCuisineType()); ?> Cuisine</span>
                    <span class="location-count"><?php echo count($chain->getLocations()); ?> Locations</span>
                </div>
            </div>
            
            <div class="chain-details">
                <div class="detail-group">
                    <h3>Company Information</h3>
                    <p><strong>Founded:</strong> <?php echo $chain->getFoundingYear(); ?></p>
                    <p><strong>CEO:</strong> <?php echo htmlspecialchars($chain->getCeo()); ?></p>
                    <p><strong>Industry:</strong> <?php echo htmlspecialchars($chain->getIndustry()); ?></p>
                    <p><strong>Parent Company:</strong> <?php echo $chain->getParentCompany() ?: 'Independent'; ?></p>
                </div>
                
                <div class="detail-group">
                    <h3>Contact Information</h3>
                    <p><strong>Website:</strong> <a href="<?php echo htmlspecialchars($chain->getWebsite()); ?>"><?php echo htmlspecialchars($chain->getWebsite()); ?></a></p>
                    <p><strong>Phone:</strong> <?php echo htmlspecialchars($chain->getPhone()); ?></p>
                </div>
            </div>
        </section>

        <!-- レストラン一覧セクション -->
        <section class="locations-list">
            <h3>Restaurant Locations</h3>
            <?php foreach ($chain->getLocations() as $location): ?>
                <div class="location-card">
                    <div class="location-header">
                        <h4><?php echo htmlspecialchars($location->getName()); ?></h4>
                        <span class="status-badge <?php echo $location->isOpen() ? 'open' : 'closed'; ?>">
                            <?php echo $location->isOpen() ? 'Open' : 'Closed'; ?>
                        </span>
                    </div>

                    <div class="location-address">
                        <p><?php echo htmlspecialchars($location->getAddress()); ?></p>
                        <p><?php echo htmlspecialchars($location->getCity()); ?>, <?php echo htmlspecialchars($location->getState()); ?> <?php echo htmlspecialchars($location->getZipCode()); ?></p>
                    </div>

                    <div class="employees-section">
                        <h5>Staff (<?php echo count($location->getEmployees()); ?>)</h5>
                        <div class="employees-grid">
                            <?php foreach ($location->getEmployees() as $employee): ?>
                                <div class="employee-card">
                                    <h6><?php echo htmlspecialchars($employee->getFirstName() . ' ' . $employee->getLastName()); ?></h6>
                                    <p class="job-title"><?php echo htmlspecialchars($employee->getJobTitle()); ?></p>
                                    <p class="start-date">Since: <?php echo $employee->getStartDate()->format('M Y'); ?></p>
                                    <?php if (count($employee->getAwards()) > 0): ?>
                                        <div class="awards">
                                            <p><strong>Awards:</strong></p>
                                            <ul>
                                                <?php foreach ($employee->getAwards() as $award): ?>
                                                    <li><?php echo htmlspecialchars($award); ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>

        <!-- データエクスポートセクション -->
        <section class="export-section">
            <h3>Export Data</h3>
            <div class="export-buttons">
                <a href="?format=html" class="btn">Export as HTML</a>
                <a href="?format=markdown" class="btn">Export as Markdown</a>
                <a href="?format=json" class="btn">Export as JSON</a>
            </div>
        </section>

    <?php else: ?>
        <div class="error-message">
            <p>No restaurant chain data available.</p>
            <a href="/generate" class="btn">Generate New Chain</a>
        </div>
    <?php endif; ?>
</div>