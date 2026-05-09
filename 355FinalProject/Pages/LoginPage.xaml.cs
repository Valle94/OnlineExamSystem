using System.Net.Http.Json;
using _355FinalProject.Models;

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

#if WINDOWS
        var response = await client.PostAsync("http://localhost/cita-355-project-1/Project1/loginNET.php", content);
#elif ANDROID
        var response = await client.PostAsync("http://10.0.2.2/cita-355-project-1/Project1/loginNET.php", content);
#endif


        var result = await response.Content.ReadFromJsonAsync<Dictionary<string, object>>();

        if (result["success"].ToString() == "true")
        {
            await DisplayAlertAsync("Success", result["message"].ToString(), "OK");
            var parameters = new Dictionary<string, object> { { "StudentID", result["studentID"].ToString() } };
            await Shell.Current.GoToAsync("/HomePage", parameters);
        }
        else
        {
            await DisplayAlertAsync("Login Failed", result["message"].ToString(), "OK");
        }
    }
}