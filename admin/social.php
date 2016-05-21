<?php  include("header.php"); ?>
    <?php include('dbconnect.php'); include("leftmenu.php"); ?>
    <form action="socialadd.php" method="post" name="frm" id="frm">
      <table width="500" border="0">        
        <tr>
          <td width="119">Social Name</td>
          <td width="371"><input type="text" name="socialname" id="socialname" />
          </td>
        </tr>
        <tr>
          <td width="119">Social Link</td>
          <td width="371"><input type="text" name="sociallink" id="sociallink" />
          </td>
        </tr>
        <tr>
          <td width="119">Social Status</td>
          <td width="248"><select name="status" id="status">             
              <option value="1">Enable</option>
              <option value="0">Disable</option>
            </select>
          </td>
        </tr>
        <tr>
          <td><label>
            <input type="submit" name="submit" id="submit" value="Submit" />
            </label>
      </table>
      <p>&nbsp;</p>
    </form>
    <?php include("footer.php"); ?>
