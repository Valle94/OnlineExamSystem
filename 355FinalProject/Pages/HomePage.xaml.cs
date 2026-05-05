namespace _355FinalProject.Pages;

public partial class HomePage : ContentPage, IQueryAttributable
{
	public HomePage()
	{
		InitializeComponent();

	}

	public void ApplyQueryAttributes(IDictionary<string, object> query)
	{
		var studentID = query["StudentID"];
		//Test.Text = studentID.ToString();
	}
}