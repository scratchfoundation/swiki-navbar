<?php
/*
This extension for the Scratch wikis creates a different navigation bar for logged in and logged out users,
hiding links that are unnecessary or confusing from non-editors. Logged out users can see the link to the main page and 
a link to a random page. Logged in users can also see a link to the community portal, the recent changes, and the help pages.

Code adapted from: 
https://www.mediawiki.org/wiki/Manual:Interface/Sidebar#Advanced_customization
*/

$wgHooks['SkinBuildSidebar'][] = 'lfHideSidebar';
function lfHideSidebar( $skin, &$bar ) {
        global $wgUser;
	//make the navigation bar have a link to the main page and a random page for all users. 
        $bar = array(
                        'navigation' => array(
                                array(
                                        'text'   => Title::newFromText( wfMsgForContent( 'mainpage' ) ),
                                        'href'   => Title::newFromText( wfMsgForContent( 'mainpage' ) )->getFullURL(),
                                        'id'     => 'mainpage',
                                        'active' => ''
                                ),
				array(
                                        'text'   => 'Random Page',
                                        'href'   => Title::newFromText( wfMsgForContent( 'randompage-url' ) )->getFullURL(),
                                        'id'     => 'randompage',
                                        'active' => ''
                                )
                        )
                );

	//add Community Portal, Recent Changes, Help to the navigation bar if the user is logged it. 
        if ($wgUser->isLoggedIn() ) {
                $bar['navigation'][] = array(
					 'text'   => 'Community Portal',
                                        'href'   => Title::newFromText( wfMsgForContent( 'portal-url' ) )->getFullURL(),
                                        'id'     => 'portal',
                                        'active' => ''
		);
		$bar['navigation'][] = array(
					 'text'   => 'Current Events',
                                        'href'   => Title::newFromText( wfMsgForContent( 'currentevents-url' ) )->getFullURL(),
                                        'id'     => 'currentevents',
                                        'active' => ''
		);
		$bar['navigation'][] = array(
					 'text'   => 'Recent Changes',
                                        'href'   => Title::newFromText( wfMsgForContent( 'recentchanges-url' ) )->getFullURL(),
                                        'id'     => 'recentchanges',
                                        'active' => ''
		);
		$bar['navigation'][] = array(
					 'text'   => 'Help',
                                        'href'   => Title::newFromText( wfMsgForContent( 'helppage' ) )->getFullURL(),
                                        'id'     => 'recentchanges',
                                        'active' => ''
		);

        }
        return true;
}
