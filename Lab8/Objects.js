function DbEntry(newName, newEmail) 
{
    this.name = newName;
    this.email = newEmail;
}
DbEntry.prototype.asString = function ()
{
    return this.name + "|" + this.email;
};

function DbHolder()
{
    this.entries = new Array();
}
DbHolder.prototype.addEntry = function (entry)
{
    this.entries.push(entry);
};
DbHolder.prototype.printDB = function (document)
{
    for (var i = 0, max = this.entries.length; i < max; i++) 
    {
        document.write(this.entries[i].asString() + "<br>");
    }
};