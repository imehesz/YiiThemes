<h1> <?php echo Yii::t('UserModule.user', 'Yii User management Module Installation'); ?> </h1>

<?php echo CHtml::beginForm(array('install')); ?>

<div class="span-12">

<h2> Information: </h2>

<hr />

<p> You are about to install the Yii User management Module in your Web 
Application. You require a working Database connection to an Mysql
Database. Other Databases are not supported at this time. Please make sure 
your Database is Accessible in protected/config/main.php. </p>

<?php if (Yii::app()->db): ?>
<div class="hint"> Your Database Connection seems to be working </div>
<?php else: ?>
<div class="error"> Your Database Connection doesn't seem to be working </div>
<?php endif; ?>

<p> <strong> Every existing Table will be deleted! If you are really sure you
want to do install the Yii-User Module, switch the 'debug' parameter to
true, run the installer and switch it back to false, so your data doesn't
get overriden accidentally. </strong> </p>

<p> This Installer will create the needed database Tables in your Database and
some Demo Data. If you want so see, what will happen exactly, look at the 
controllers/InstallController.php file in the Module Source. </p>

<p> Note that the Yii User management Module does not contain any css files and
almost no predefined layout, so that you can easily integrate this module in
your already existing Web Application. Use the config parameters 'layout' to
specify which layout the User Module should use. </p>

<p> The API Documentation, examples and an Database Schema for Mysql Workbench
can be found in the docs/ directory of the Module. Please also take a look
in this directory when you want to use the Role Manager of yii-user. </p>

<p> To set the language of this Module, set the 'language' config param of
your Yii Web Application </p>

<p> Don't forget to copy overwrite your UserIdentity.php with 
 modules/user/components/UserIdentity.php, so your Webapp uses the User
Module Authentification. </p> 

</div>

<div class="span-11 last">

<h2> Configuration: </h2>

<hr />

<p> the Yii User Manager will generate the following Tables: </p>

<table>
<tr> 
<td> Table for Users </td>
<td> <?php echo CHtml::textField('usersTable', Yii::app()->controller->module->usersTable); ?> </td> </tr>
<tr> 
<td> Table for Messages </td>

<td> <?php echo CHtml::textField('messagesTable', Yii::app()->controller->module->messagesTable); ?> </td> </tr>
<tr> 
<td> Table for the Profile Fields </td>
<td> <?php echo CHtml::textField('profileFieldsTable', Yii::app()->controller->module->profileFieldsTable); ?> </td> </tr>
<tr> 
<td> Table for the Profiles </td>
<td> <?php echo CHtml::textField('profileTable', Yii::app()->controller->module->profileTable); ?> </td> </tr>
<tr> 
<td> Table for the Roles </td>
<td> <?php echo CHtml::textField('rolesTable', Yii::app()->controller->module->rolesTable); ?> </td> </tr>
<tr> 
<td> Table for the Role Assignment(user_has_role)</td>
<td> <?php echo CHtml::textField('userRoleTable', Yii::app()->controller->module->userRoleTable); ?> </td> </tr>
</table>

<div style="clear:both;"> </div>

<?php echo CHtml::submitButton(Yii::t('UserModule.user', 'Install Module')); ?>
<?php echo CHtml::endForm(); ?>

