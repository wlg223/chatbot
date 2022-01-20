
import sys
import re
import json
import string
import nltk
from nltk.tokenize import word_tokenize
from nltk.corpus import stopwords
from nltk.stem import PorterStemmer
nltk.download('punkt')
nltk.download('stopwords')

# print(sys.argv[1])
# print("Cat")

stemmer = PorterStemmer()

txt = sys.argv
#txt = '1|When I do my deserialize message method I get the four bytes for the int field of timestamp I made my array of unsigned chars which are 0 0 0 3. I am sure of them being these values. However, when I run them through the deserialize int function it returns an int value of 768. Anyone know how I\'m getting here, I\'m using the provided method from classwork.|deserialize message; technical question;||deserialize int expects an int message, which is 5 bytes including the type header: e.g. 1 0 0 0 3|13'


str1 = ""

for ele in txt[1:]:
    str1 += ele
    str1 += " "

txt = str1

txt = txt.lower()

str = ""
list = []
a_list = []
num = 0

# Splits text into id|problem|subject|error|answer|pid
for char in txt:
    if char == '|':
        list.append(str)
        str = ""
        continue
    str = str+char

list.append(str)
# print(list)

stop_words = set(stopwords.words('english'))

for x in range(1, 5):

    # Removes Numbers from Text
    result = re.sub(r'\d+', '', list[x])
    list[x] = result

    # Removes Punctuation
    translator = str.maketrans('', '', string.punctuation)
    result = list[x].translate(translator)
    list[x] = result

    # Removes Whitespaces
    list[x].replace(" ", "")

    # Tokenizes the Text
    # tokens = word_tokenize(list[x])
    # list[x] = [i for i in tokens if not i in stop_words]

    # # Stems the Text
    # s_list = []
    # s_list = [stemmer.stem(word) for word in list[x]]

    # for word in list[x]:
    #     if word != "":
    #         s_list.append(stemmer.stem(word))
    #     else:
    #         continue

    #list[x] = s_list

# print('\n')
print(json.dumps(list))
# print(list)
# print('\n')
