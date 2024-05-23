<div class="dialogContainer">
  <div class="dialogContents">
    <form action="?" method="get" accept-charset="UTF-8">
      <div class="dialogDragBar"></div>
      <div class="iconButton small info" style="display: none;"></div>
      <div class="dialogCancelButton iconButton small cancel"></div>
      <div class="content" id="dialogContent">
        <div id="troops" class="instantTabs">
          <h3><img src="/img/x.gif" class="unit uunits"> Troops</h3>
          <div class="contentNavi tabNavi ">
            <div title="" class="container  active">
              <div class="background-start">&nbsp;</div>
              <div class="background-end">&nbsp;</div>
              <div class="content">
                <a id="button6555b07377d76" href="#tabContent1" class="tabItem">Romans</a>
              </div>
            </div>
            <div title="" class="container  normal">
              <div class="background-start">&nbsp;</div>
              <div class="background-end">&nbsp;</div>
              <div class="content">
                <a id="button6555b07377d7a" href="#tabContent2" class="tabItem">Teutons</a>
              </div>
            </div>
            <div title="" class="container  normal">
              <div class="background-start">&nbsp;</div>
              <div class="background-end">&nbsp;</div>
              <div class="content">

                <a id="button6555b07377d7b" href="#tabContent3" class="tabItem">
                  Gauls </a>
              </div>
            </div>
            <div title="" class="container  normal">
              <div class="background-start">&nbsp;</div>
              <div class="background-end">&nbsp;</div>
              <div class="content">
                <a id="button6555b07377d7c" href="#tabContent4" class="tabItem">
                  Egyptians </a>
              </div>
            </div>
            <div title="" class="container  normal">
              <div class="background-start">&nbsp;</div>
              <div class="background-end">&nbsp;</div>
              <div class="content">
                <a id="button6555b07377d7d" href="#tabContent5" class="tabItem">
                  Huns </a>
              </div>
            </div>
            <div class="clear"></div>
          </div>
          <div class="tabContainer1 ">
            <div id="tabContent1" class="tabContainer">
              <ul class="troops1">
                <?php
$unit_info = [
    1 => 'Legionnaire',
    2 => 'Praetorian',
    3 => 'Imperian',
    4 => 'Equites Legati',
    5 => 'Equites Imperatoris',
    6 => 'Equites Caesaris',
    7 => 'Battering ram',
    8 => 'Fire Catapult',
    9 => 'Senator',
    10 => 'Settler',
    // Add units 11 to 20 here if needed
];

foreach ($unit_info as $unit_number => $unit_name) {
    echo '<li>';
    echo '<img src="/img/x.gif" class="unit u' . $unit_number . '">';
    echo '<a href="manual.php?typ=1&gid=' . $unit_number . '">' . $unit_name . '</a>';
    echo '</li>';
}
?>
              </ul>
            </div>
            <div class="clear"></div>
          </div>
          <div class="tabContainer2 ">
            <div id="tabContent2" class="tabContainer">
              <ul class="troops2">
                <?php
$unit_info = [
    11 => 'Clubswinger',
    12 => 'Spearman',
    13 => 'Axeman',
    14 => 'Scout',
    15 => 'Paladin',
    16 => 'Teutonic Knight',
    17 => 'Ram',
    18 => 'Catapult',
    19 => 'Chief',
    20 => 'Settler'
];

foreach ($unit_info as $unit_number => $unit_name) {
    echo '<li>';
    echo '<img src="/img/x.gif" class="unit u' . $unit_number . '">';
    echo '<a href="manual.php?typ=1&gid=' . $unit_number . '">' . $unit_name . '</a>';
    echo '</li>';
}
?>
              </ul>
            </div>
            <div class="clear"></div>
          </div>
          <div class="tabContainer3 ">
            <div id="tabContent3" class="tabContainer">
              <ul class="troops3">
                <?php
$unit_info = [
    21 => 'Phalanx',
    22 => 'Swordsman',
    23 => 'Pathfinder',
    24 => 'Theutates Thunder',
    25 => 'Druidrider',
    26 => 'Haeduan',
    27 => 'Ram',
    28 => 'Trebuchet',
    29 => 'Chieftain',
    30 => 'Settler',
    // Add units 31 to 40 here if needed
];

foreach ($unit_info as $unit_number => $unit_name) {
    echo '<li>';
    echo '<img src="/img/x.gif" class="unit u' . $unit_number . '">';
    echo '<a href="manual.php?typ=1&gid=' . $unit_number . '">' . $unit_name . '</a>';
    echo '</li>';
}
?>
              </ul>
            </div>
            <div class="clear"></div>
          </div>
          <div class="tabContainer4 ">
            <div id="tabContent4" class="tabContainer">
              <ul class="troops4">
                <?php
$unit_info = [
    51 => 'Slave Militia',
    52 => 'Ash Warden',
    53 => 'Khopesh Warrior',
    54 => 'Sopdu Explorer',
    55 => 'Anhur Guard',
    56 => 'Resheph Chariot',
    57 => 'Ram',
    58 => 'Stone Catapult',
    59 => 'Nomarch',
    60 => 'Settler',
    // Add units 61 to 70 here if needed
];

foreach ($unit_info as $unit_number => $unit_name) {
    echo '<li>';
    echo '<img src="/img/x.gif" class="unit u' . $unit_number . '">';
    echo '<a href="manual.php?typ=1&gid=' . $unit_number . '">' . $unit_name . '</a>';
    echo '</li>';
}
?>
              </ul>
            </div>
            <div class="clear"></div>
          </div>
          <div class="tabContainer5 ">
            <div id="tabContent5" class="tabContainer">
              <ul class="troops5">
                <?php
$unit_info = [
    61 => 'Mercenary',
    62 => 'Bowman',
    63 => 'Spotter',
    64 => 'Steppe Rider',
    65 => 'Marksman',
    66 => 'Marauder',
    67 => 'Ram',
    68 => 'Catapult',
    69 => 'Logades',
    70 => 'Settler',
    // Add units 71 to 80 here if needed
];

foreach ($unit_info as $unit_number => $unit_name) {
    echo '<li>';
    echo '<img src="/img/x.gif" class="unit u' . $unit_number . '">';
    echo '<a href="manual.php?typ=1&gid=' . $unit_number . '">' . $unit_name . '</a>';
    echo '</li>';
}
?>
              </ul>
            </div>
          </div>
          <div id="buildings" class="instantTabs">
            <h3><img src="/img/x.gif" class="gebIcon"> Buildings</h3>
            <div class="contentNavi tabNavi ">
              <div title="" class="container  active">
                <div class="background-start">&nbsp;</div>
                <div class="background-end">&nbsp;</div>
                <div class="content">
                  <a id="button6555b07377eee" href="#infrastructureContent" class="tabItem">Infrastructure</a>
                </div>
              </div>
              <div title="" class="container  normal">
                <div class="background-start">&nbsp;</div>
                <div class="background-end">&nbsp;</div>
                <div class="content">
                  <a id="button6555b07377eef" href="#militaryContent" class="tabItem">Military</a>
                </div>
              </div>
              <div title="" class="container  normal">
                <div class="background-start">&nbsp;</div>
                <div class="background-end">&nbsp;</div>
                <div class="content">
                  <a id="button6555b07377ef0" href="#resourcesContent" class="tabItem">Resources</a>
                </div>
              </div>
              <div class="clear"></div>
            </div>
            <div id="infrastructureContent" class="tabContainer">
              <ul class="buildings1">
                <?php
$building_info = [
    10 => 'Warehouse',
    11 => 'Granary',
    15 => 'Main Building',
    17 => 'Marketplace',
    18 => 'Embassy',
    23 => 'Cranny',
    24 => 'Town Hall',
    25 => 'Residence',
    26 => 'Palace',
    27 => 'Treasury',
    28 => 'Trade Office',
    34 => "Stonemason's Lodge",
    35 => 'Brewery',
    38 => 'Great Warehouse',
    39 => 'Great Granary',
    40 => 'Wonder Of The World',
    41 => 'Horse Drinking Trough',
    44 => 'Command Center',
    45 => 'Waterworks',
    // Add buildings here if needed
];

foreach ($building_info as $building_number => $building_name) {
    echo '<li>';
    echo '<img src="/img/x.gif" class="gebIcon g' . $building_number . 'Icon">';
    echo '<a href="manual.php?typ=4&gid=' . $building_number . '">' . $building_name . '</a>';
    echo '</li>';
}
?>
              </ul>
            </div>
            <div id="militaryContent" class="tabContainer">
              <ul class="buildings2">
                <?php
$building_info = [
    12 => 'Smithy',
    14 => 'Tournament Square',
    16 => 'Rally Point',
    19 => 'Barracks',
    20 => 'Stable',
    21 => 'Workshop',
    22 => 'Academy',
    29 => 'Great Barracks',
    30 => 'Great Stable',
    31 => 'City Wall',
    32 => 'Earth Wall',
    33 => 'Palisade',
    36 => 'Trapper',
    37 => "Hero's Mansion",
    42 => 'Stone Wall',
    43 => 'Makeshift Wall',
    46 => 'Hospital',
    // Add more buildings here if needed
];

foreach ($building_info as $building_number => $building_name) {
    echo '<li>';
    echo '<img src="/img/x.gif" class="gebIcon g' . $building_number . 'Icon">';
    echo '<a href="manual.php?typ=4&gid=' . $building_number . '">' . $building_name . '</a>';
    echo '</li>';
}
?>
              </ul>
            </div>
            <div id="resourcesContent" class="tabContainer">
              <ul class="buildings3">
                <?php
$building_info = [
    1 => 'Woodcutter',
    2 => 'Clay Pit',
    3 => 'Iron Mine',
    4 => 'Cropland',
    5 => 'Sawmill',
    6 => 'Brickyard',
    7 => 'Iron Foundry',
    8 => 'Grain Mill',
    9 => 'Bakery',
    // Add more buildings here if needed
];

foreach ($building_info as $building_number => $building_name) {
    echo '<li>';
    echo '<img src="/img/x.gif" class="gebIcon g' . $building_number . 'Icon">';
    echo '<a href="manual.php?typ=4&gid=' . $building_number . '">' . $building_name . '</a>';
    echo '</li>';
}
?>
              </ul>
            </div>
          </div>
        </div>
        <div class="buttons" style="display: none;"><button class="green dialogButtonOk ok textButtonV1" type="submit">
          </button></div>
    </form>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    function handleTabSwitching(event) {
      // Prevent the default anchor behavior
      event.preventDefault();

      // Get the clicked tab and the associated content ID
      var clickedTab = event.target;
      var contentId = clickedTab.getAttribute('href').substring(1);

      // Get the parent container of the clicked tab
      var tabContainer = clickedTab.closest('.contentNavi');

      // Get all tab links within the same container as the clicked tab
      var tabLinks = tabContainer.getElementsByClassName('tabItem');

      // Loop through all tab links to deactivate them and hide their content
      for (var i = 0; i < tabLinks.length; i++) {
        var tabLink = tabLinks[i];

        var tabContentId = tabLink.getAttribute('href').substring(1);
        var tabContent = document.getElementById(tabContentId);
        if (tabContent) {
          tabContent.style.display = 'none';
        }

        // Remove the 'container active' class from all tab containers
        var tabContainer = tabLink.closest('.container');
        if (tabContainer) {
          tabContainer.classList.remove('active');
        }
      }

      // Add the 'container active' class to the container of the clicked tab
      var activeTabContainer = clickedTab.closest('.container');
      if (activeTabContainer) {
        activeTabContainer.classList.add('active');
      }

      // Show the content associated with the clicked tab
      var activeContent = document.getElementById(contentId);
      if (activeContent) {
        activeContent.style.display = 'block';
      }
    }

    // Add click event listeners to all tabs
    var tabs = document.querySelectorAll('.tabItem');
    tabs.forEach(function(tab) {
      tab.addEventListener('click', handleTabSwitching);
    });

    // Activate the first tab of each group by default
    var tabGroups = document.querySelectorAll('.instantTabs');
    tabGroups.forEach(function(group) {
      var firstTab = group.querySelector('.tabItem');
      if (firstTab) {
        firstTab.click();
      }
    });
  });
</script>