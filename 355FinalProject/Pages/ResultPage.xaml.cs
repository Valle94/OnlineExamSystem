using _355FinalProject.Models;

namespace _355FinalProject.Pages;

public partial class ResultPage : ContentPage, IQueryAttributable
{

	public ResultPage()
	{
		InitializeComponent();
	}

    public void ApplyQueryAttributes(IDictionary<string, object> query)
    {
        StudentId.Text = query["studentID"].ToString();
        FirstName.Text = query["firstName"].ToString();
        LastName.Text = query["lastName"].ToString();
        Email.Text = query["email"].ToString();
        Score.Text = query["score"].ToString();
        Correct.Text = query["correctCount"].ToString();
        Wrong.Text = query["wrongCount"].ToString();
        Date.Text = query["date"].ToString();
        Time.Text = query["time"].ToString();
        Q1Student.Text = query["studentAnsQ1"].ToString();
        Q2Student.Text = query["studentAnsQ2"].ToString();
        Q3Student.Text = query["studentAnsQ3"].ToString();
        Q4Student.Text = query["studentAnsQ4"].ToString();
        Q5Student.Text = query["studentAnsQ5"].ToString();



    }

    private async void GoHome(object sender, EventArgs e)
    {
       await Shell.Current.GoToAsync("///HomePage");
    }
}