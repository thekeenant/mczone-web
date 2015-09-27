<div class="page-header">
	<h1>Jobs <small>Job opportunities here at MC Zone</small></h1>
</div>

<h4>Java Developer</h4>
<p>
	MC Zone has grown from a small community of players to a huge population of 100,000+ users with thousands playing every day. We are constantly looking to expand and on the look 
	out for a skilled programmers. We are currently looking for a Java Developer that matches the following specifications. You will be paid by the project and based on the project
	complexity and level of difficulty.
	<ul>
		<li>Bukkit Development (this is what you would be programming for)</li>
		<li>A portfolio of previous projects (nothing fancy)</li>
		<li>2+ years of Java Experience</li>
		<li>At minimum, 4 hours of time per week dedicated to MC Zone</li>
		<li>Skilled in Java, MySQL, and Linux</li>
	</ul>
</p>

To inquire about a job, email us at <a href="mailto:info@mczone.co">info@mczone.co</a>.

<?php  
 // Standard inclusions     
 include("inc/pChart/pData.class");  
 include("inc/pChart/pChart.class");  
  
 // Dataset definition   
 $DataSet = new pData;  
 $DataSet->AddPoint(array(1,4,3,4,3,3,2,1,0,7,4,3,2,3,3,5,1,0,7),"Serie1");  
 $DataSet->AddPoint(array(1,4,2,6,2,3,0,1,5,1,2,4,5,2,1,0,6,4,2),"Serie2");  
 $DataSet->AddAllSeries();  
 $DataSet->SetAbsciseLabelSerie();  
 $DataSet->SetSerieName("January","Serie1");  
 $DataSet->SetSerieName("February","Serie2");  
  
 // Initialise the graph  
 $Test = new pChart(700,230);  
 $Test->setFixedScale(-2,8);  
 $Test->setFontProperties("inc/Fonts/tahoma.ttf",8);  
 $Test->setGraphArea(50,30,585,200);  
 $Test->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);  
 $Test->drawRoundedRectangle(5,5,695,225,5,230,230,230);  
 $Test->drawGraphArea(255,255,255,TRUE);  
 $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2);     
 $Test->drawGrid(4,TRUE,230,230,230,50);  
  
 // Draw the 0 line  
 $Test->setFontProperties("inc/Fonts/tahoma.ttf",6);  
 $Test->drawTreshold(0,143,55,72,TRUE,TRUE);  
  
 // Draw the cubic curve graph  
 $Test->drawCubicCurve($DataSet->GetData(),$DataSet->GetDataDescription());  
  
 // Finish the graph  
 $Test->setFontProperties("inc/Fonts/tahoma.ttf",8);  
 $Test->drawLegend(600,30,$DataSet->GetDataDescription(),255,255,255);  
 $Test->setFontProperties("inc/Fonts/tahoma.ttf",10);  
 $Test->drawTitle(50,22,"Example 1",50,50,50,585);  
 $Test->Render("example1.png");
?>  