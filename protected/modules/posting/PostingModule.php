<?php

/**
 * PollModule class file.
 *
 * @author Matt Kelliher
 * @license New BSD License
 * @version 0.9.2b
 */

/**
 * The Poll extension allows you to create polls for users to vote on.
 * Votes can be restricted by user ID, as well as by IP address.
 *
 * Installation:
 *   In order for this to work properly, you must have a User class
 *   where Yii::app()->user->id returns an integer id for the user.
 *   Also, you must configure/install the schema file located in:
 *     /data/poll.sql
 *   and adjust the tables & PollVote user_id foreign key as needed.
 *
 * Configuration:
 * <pre>
 * return array(
 *    ...
 *    'import' => array(
 *      'application.modules.poll.models.*',
 *      'application.modules.poll.components.*',
 *    ),
 *    'modules' => array(
 *      'poll' => array(
 *        // Force users to vote before seeing results
 *        'forceVote' => TRUE,
 *        // Restrict anonymous votes by IP address,
 *        // otherwise it's tied only to user_id 
 *        'ipRestrict' => TRUE,
 *        // Allow guests to cancel their votes
 *        // if ipRestrict is enabled
 *        'allowGuestCancel' => FALSE,
 *      ),
 *    ),
 * );
 * </pre>
 *
 * Usage:
 *
 * The Poll extension has the basic Gii-created CRUD functionality,
 * as well as a portlet to load elsewhere.
 *
 * To load the latest poll:
 * <pre>
 * $this->widget('EPoll');
 * </pre>
 *
 * To load a specific poll:
 * <pre>
 * $this->widget('EPoll', array('poll_id' => 1));
 * </pre>
 */

class PostingModule extends CWebModule
{
  public $defaultController = 'Default';

  /**
   * @property boolean Force users to vote before seeing results.
   */
  //public $forceVote = TRUE;

  public function init()
  {
    $this->setImport(array(
      'posting.components.*',
      'posting.models.*',
    ));

    //$assetsFolder = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.poll.assets'));
    //Yii::app()->clientScript->registerCssFile($assetsFolder .'/poll.css');
    
    $this->layoutPath = Yii::app()->layoutPath; 
  }
  
    public function beforeControllerAction($controller, $action)
    {
        if(parent::beforeControllerAction($controller, $action))
        {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        }
        else
            return false;
    }  
}
