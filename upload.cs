public class Upload 
{ 
        private static string uploadURL = "http://yoursite.com/upload.php?key=abc123";

        private void SelectFile()
        {
            var dialog = new OpenFileDialog();

            if (dialog.ShowDialog() == true) // == true is needed to convert bool? to bool
            {
                var response = new WebClient().UploadFile(uploadURL, "POST", dialog.FileName);
                var jsonResponse = JsonConvert.DeserializeObject<Dictionary<String, String>>(Encoding.UTF8.GetString(response)); // use nuget it get Newtonsoft.Json
                if (jsonResponse["status"] == "error")
                {
                    MessageBox.Show(jsonResponse["error"]); // please handle me better
                    return;
                }
                MessageBox.Show(jsonResponse["url"]); // please place me somewhere in a variable
            }
            
        }
}