namespace _355FinalProject.Pages;

public partial class LoginPage : ContentPage
{
	public LoginPage()
	{
		InitializeComponent();
	}

    private void ClearFormClicked(object sender, EventArgs e)
    {
		EmailEntry.Text = PasswordEntry.Text = string.Empty;
    }
    
    private async void LoginClicked(object sender, EventArgs e)
    {
        var client = new HttpClient();
        var data = new Dictionary<string, string>
        {
            { "Email", EmailEntry.Text },
            { "Password", PasswordEntry.Text }
        };
        var content = new FormUrlEncodedContent(data);
        var response = await client.PostAsync("http://localhost/cita-355-project-1/Project1/loginNET.php", content);
        string result = (await response.Content.ReadAsStringAsync()).Trim();

        switch (result)
        {
            case ("Account not found." or "Incorrect Password"):
                await DisplayAlertAsync("Success", result, "OK");
                break;
            case ("Login Successful!"):
                await DisplayAlertAsync("Success", result, "OK");
                await Shell.Current.GoToAsync("/HomePage");
                break;
            default:
                await DisplayAlertAsync("Success", result, "OK");
                break;
        }

    }
}