#Author: Dakota Deets 3/12/2024
#python script designed to auto generate the required html files 
#to navigate from your movie library, to any given movie.


# import required module
import os


#Movies portion
# assign directory
directory = 'Movies'

template = open("list.html", "r")


#wipe the page
pageResult = open("listTest.html", "w")
pageResult.write("")
pageResult.close()

#ammend the logo, nav bar, and heading.
pageResult = open("listTest.html", "a")
pageResult.write(template.read(808))



#build out the table in html starting from under <h1>Movies</h1>
#fist open the table tag
pageResult.write("<table>\n")

movies = 0
#then read every movie's name
for filename in os.listdir(directory):
    f = os.path.join(directory, filename)
    # checking if it is a file (todo: data trap non video files)
    if os.path.isfile(f):
        pageResult.write("      <tr>\n")
        pageResult.write("          <th>")
        pageResult.write("<a href=\""+"Pages/"+"movieId" + str(movies) + ".html"+"\">"+filename+"</a>")
        pageResult.write("</th>\n")
        pageResult.write("      </tr>\n") 
    #after we generate its spot in the table, we need to generate that videos html page
    #wipe it if it exists
    videoPage = open("Pages/movieId" + str(movies) + ".html", "w")
    videoPage.write("")
    videoPage.close()

    #now fill it with html
    videoPage = open("Pages/movieId" + str(movies) + ".html", "a")

    #open our video template
    videoTemplate = open("test.html", "r")
    videoPage.write(videoTemplate.read(790))
    #close now that we're done with it
    videoTemplate.close()

    #write the rest of the html to the new page
    videoPage.write("<source src=\""+"../Movies/" + filename +"\" type=\"video/mp4\">\n")
    videoPage.write("    Your browser does not support the video tag.\n")
    videoPage.write("  </video>\n")
    videoPage.write("</div>\n")
    videoPage.write("</body>\n")
    videoPage.write("</html>\n")
    videoPage.close()
    movies = movies + 1

#now close the table and body tags
pageResult.write("</table>")
pageResult.write("</body>")

pageResult.close()






