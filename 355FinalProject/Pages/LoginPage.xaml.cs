using System.Net.Http.Json;

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
        var result = await response.Content.ReadFromJsonAsync<List<string>>();

        var parameters = new Dictionary<string, object>
        {
            { "StudentID", result[1] }
        };

        switch (result[0])
        {
            case ("Account not found." or "Incorrect Password"):
                await DisplayAlertAsync("Success", result[0], "OK");
                break;
            case ("Login Successful!"):
                await DisplayAlertAsync("Success", result[0], "OK");
                await Shell.Current.GoToAsync("/HomePage", parameters);
                break;
            default:
                await DisplayAlertAsync("Success", result[0], "OK");
                break;
        }

    }
}