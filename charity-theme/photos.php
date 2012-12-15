<?php
	echo'<data>
		<settings>
		<width>230</width>
		<height>300</height>
		<borderWidth>3</borderWidth>
		<minRotation>-45</minRotation>
		<maxRotation>45</maxRotation>
		<minXOffSet>-30</minXOffSet>
		<maxXOffSet>30</maxXOffSet>
		<minYOffSet>-30</minYOffSet>
		<maxYOffSet>30</maxYOffSet>
		<transitionTime>0.5</transitionTime>
		<transitionType>easeoutquad</transitionType>
	</settings>';
	echo'<images>';
	echo get_media_images();		
	echo'</images>';	
	
	echo'</data>';
?>