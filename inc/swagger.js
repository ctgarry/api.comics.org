{
  "swagger" : "2.0",
  "externalDocs" : {	
    "url" : "https://docs.comics.org/wiki/Main_Page#Technical_Details",	
    "description" : "Technical Details"	
  },	
  "info" : {	
    "termsOfService" : "https://www.comics.org/privacy/",	
    "description" : "The Consumer Inquiry API returns the information of a comics index that can be used for informational display purposes by a Trusted Partner.",	
    "version" : "1.0.0",	
    "title" : "Grand Comics Database API",	
    "contact" : {	
      "url" : "https://www.comics.org/contact/",	
      "name" : "Support at Grand Comics Database",	
      "email" : "support@comics.org"	
    },	
    "license" : {	
      "name" : "GNU General Public License.",	
      "url" : "http://www.gnu.org/licenses/gpl.html"	
    }	
  },	
  "tags" : [ {	
    "name" : "admins",	
    "description" : "Secured Admin-only calls"	
  }, {	
    "name" : "developers",	
    "description" : "Operations available to regular developers"	
  } ],	
  "paths" : {	
    "/story" : {	
      "get" : {	
        "tags" : [ "developers" ],	
        "summary" : "The operation facilitates the consumer obtaining  stories one at a time by id.",	
        "operationId" : "getStoryByID",	
        "description" : "By passing in the appropriate options, you can search for available stories in the system.\n",	
        "produces" : [ "application/json" ],	
        "parameters" : [ {	
          "in" : "query",	
          "name" : "storyID",	
          "description" : "pass an ID for looking up a story",	
          "required" : true,	
          "type" : "string"	
        }, {	
          "in" : "query",	
          "name" : "skip",	
          "description" : "number of records to skip for pagination",	
          "required" : false,	
          "type" : "integer",	
          "format" : "int32",	
          "minimum" : 0,	
          "maximum" : 0	
        }, {	
          "in" : "query",	
          "name" : "limit",	
          "description" : "maximum number of records to return",	
          "required" : false,	
          "type" : "integer",	
          "format" : "int32",	
          "minimum" : 0,	
          "maximum" : 1	
        } ],	
        "responses" : {	
          "200" : {	
            "description" : "search results matching criteria",	
            "schema" : {	
              "type" : "array",	
              "items" : {	
                "$ref" : "#/definitions/Story"	
              }	
            }	
          },	
          "400" : {	
            "description" : "bad input parameter"	
          }	
        }	
      },	
      "post" : {	
        "tags" : [ "admins" ],	
        "summary" : "adds a story",	
        "operationId" : "addStory",	
        "description" : "Adds a story to the system.\n",	
        "consumes" : [ "application/json" ],	
        "produces" : [ "application/json" ],	
        "parameters" : [ {	
          "in" : "body",	
          "name" : "storyItem",	
          "description" : "Story item to add",	
          "schema" : {	
            "$ref" : "#/definitions/Story"	
          }	
        } ],	
        "responses" : {	
          "201" : {	
            "description" : "item created"	
          },	
          "400" : {	
            "description" : "invalid input, object invalid"	
          },	
          "409" : {	
            "description" : "an existing item already exists"	
          }	
        }	
      }	
    }	
  },	
  "definitions" : {	
    "Character" : {	
      "description" : "This embodies the data found when visiting a GCD website URL conveying an issue plus the specific story detail. For example, https://www.comics.org/issue/1234/#17905 links to issue 1234 and takes the the reader straight to the \"cover\" sequence. The character list for this single sequence is \"The Hourman; the Sandman (inset)\". Frequently, characters associated with a single sequence are multiple, and on the website are separated with semi-colons.\n",	
      "required" : [ "id", "name" ],	
      "properties" : {	
        "id" : {	
          "type" : "integer",	
          "example" : 94	
        },	
        "name" : {	
          "type" : "string",	
          "example" : "Superhero"	
        },	
        "alter-ego" : {	
          "type" : "string",	
          "example" : "Clark Kent"	
        },	
        "birthname" : {	
          "type" : "string",	
          "example" : "Kal-El"	
        },	
        "homeworld" : {	
          "type" : "string",	
          "example" : "Krypton"	
        }	
      }	
    },	
    "Creator" : {	
      "description" : "This embodies the data found when visiting a GCD website URL conveying an issue plus the specific story detail. For example, https://www.comics.org/issue/1234/#17906 links to issue 1234 and takes the the reader straight to the 8-page Hourman story. The creators can appear in each of the fields about story, pencils, inks, colors, letters or editor. In this way a creator can appear more than once in a story, and there are often multiple creators in a single credits field. On the website multiples are separated by semi-colons.\n",	
      "required" : [ "id", "name" ],	
      "properties" : {	
        "id" : {	
          "type" : "integer",	
          "example" : 45	
        },	
        "gcd-official-name-first" : {	
          "type" : "string",	
          "example" : "Ed"	
        },	
        "gcd-official-name-last" : {	
          "type" : "string",	
          "example" : "Hannigan"	
        },	
        "birth-year" : {	
          "type" : "integer",	
          "example" : 1957	
        },	
        "birth-country" : {	
          "type" : "string",	
          "example" : "United States"	
        }	
      }	
    },	
    "Feature" : {	
      "description" : "This embodies the data found when visiting a GCD website URL conveying an issue plus the specific story detail. For example, https://www.comics.org/issue/1234/#17905 links to issue 1234 and takes the the reader straight to the \"cover\" sequence. The feature for this single sequence is \"The Hourman\". On rare occasions the feature for a single sequence can be multiple, and on the website they are separated with semi-colons.\n",	
      "required" : [ "id", "name" ],	
      "properties" : {	
        "id" : {	
          "type" : "integer",	
          "example" : 23	
        },	
        "name" : {	
          "type" : "string",	
          "example" : "Superman"	
        }	
      }	
    },	
    "Genre" : {	
      "description" : "This embodies the data found when visiting a GCD website URL conveying an issue plus the specific story detail. For example, https://www.comics.org/issue/1234/#17905 links to issue 1234 and takes the the reader straight to the \"cover\" sequence. The genre for this single sequence is \"superhero\". On rare occasions the genre for a single sequence can be multiple, and on the website these are separated with semi-colons.\n",	
      "required" : [ "id", "name" ],	
      "properties" : {	
        "id" : {	
          "type" : "integer",	
          "example" : 34	
        },	
        "name" : {	
          "type" : "string",	
          "example" : "Superhero"	
        }	
      }	
    },	
    "Story" : {	
      "description" : "The story table would more accurately be called the sequence table. A single story records the contents of one sequence in an issue, whether they are actual sequential art stories, text stories, covers, advertisements or any number of other sequence types. This data is found when visiting a GCD website URL conveying an issue plus the specific story detail. Data table name is gcd_story; code class is apps.gcd.models.Story; example URL is https://www.comics.org/issue/1234/#17905\n",	
      "required" : [ "id" ],	
      "properties" : {	
        "id" : {	
          "type" : "integer",	
          "example" : 2345214,	
          "description" : "DB-generated unique, primary key."	
        },	
        "sequence_number" : {	
          "type" : "integer",	
          "example" : 3,	
          "description" : "Order of the story within the issue. Sequence number of 0 (almost) always indicates the issue's cover sequence."	
        },	
        "title" : {	
          "type" : "string",	
          "example" : "Welcome Home",	
          "description" : "The title of the story, or a quote from the beginning of the script if there is no title."	
        },	
        "first-line" : {	
          "type" : "string",	
          "example" : "Meanwhile...",	
          "description" : "The quote from the beginning of the script."	
        },	
        "type" : {	
          "type" : "string",	
          "example" : "cover",	
          "description" : "Foreign key to the data_story_type table (id column). Type of 'story', or more accurately sequence.\tActual comic story, text story, advertisement, or letters page, etc."	
        },	
        "feature" : {	
          "type" : "array",	
          "items" : {	
            "$ref" : "#/definitions/Feature"	
          },	
          "description" : "The name of the feature, if any. Typically as from the splash or title page, but with some exceptions. Often but not always the name of the primary character. Some stories do not have a feature."	
        },	
        "genre" : {	
          "type" : "array",	
          "items" : {	
            "$ref" : "#/definitions/Genre"	
          },	
          "description" : "One or more genres, separated by semicolons."	
        },	
        "job-number" : {	
          "type" : "string",	
          "example" : "X-219; EA165",	
          "description" : "Some comic stories have a small number or number/letter combination written on the first page of the story. It can also appear at the edge of a cover or a pin-up. This was a unique code number assigned to each art job by some publishers. It should be entered here, as closely to how it is written in the book as possible, including hyphens and spaces. These numbers are often useful for tracking reprints, especially international reprints where the title of the story may be translated into a different language. A job number can also be sometimes referred to as an \"inventory code\"."	
        },	
        "script" : {	
          "type" : "array",	
          "items" : {	
            "$ref" : "#/definitions/Creator"	
          },	
          "description" : "Writer, scripter and/or (co-)plotter credits."	
        },	
        "pencils" : {	
          "type" : "array",	
          "items" : {	
            "$ref" : "#/definitions/Creator"	
          },	
          "description" : "Pencils or other primary artwork (painting, photography, etc.) or layouts / breakdowns and finishing pencils."	
        },	
        "inks" : {	
          "type" : "array",	
          "items" : {	
            "$ref" : "#/definitions/Creator"	
          },	
          "description" : "Inks or other artwork that completes the primary artwork. Painting / photography is credited both here and in pencils, and possibly colors."	
        },	
        "colors" : {	
          "type" : "array",	
          "items" : {	
            "$ref" : "#/definitions/Creator"	
          },	
          "description" : "Color added to non-colored artwork, or similar image processing. Painting / color photography are credited both here and in pencils, and possibly inks."	
        },	
        "letters" : {	
          "type" : "array",	
          "items" : {	
            "$ref" : "#/definitions/Creator"	
          },	
          "description" : "Lettering. For text not designed/produced by a letterer, uses \"typeset\" (for instance typewritten text stories word processor output not done in word balloons or captions)."	
        },	
        "editing" : {	
          "type" : "array",	
          "items" : {	
            "$ref" : "#/definitions/Creator"	
          },	
          "description" : "Details regarding editing for this individual story, as opposed to the editing notes for the whole issue.\tRarely used except for sequence 0, as the editor for the book is typically assumed to have edited the whole book. However, this field can be used if individual stories have separate editors such as certain original anthologies or collections covering diverse material."	
        },	
        "page-count" : {	
          "type" : "number",	
          "example" : 5.5,	
          "description" : "Number of pages. One side counts as one page. The front cover, inside front cover, inside back cover and back cover add up to four and all can contribute to the sequence page count."	
        },	
        "characters" : {	
          "type" : "array",	
          "items" : {	
            "$ref" : "#/definitions/Character"	
          },	
          "description" : "Characters appearing should be populated in this field. Sometimes only recurring characters, but sometimes including things like \"unnamed boy\" or \"Nazis\"."	
        },	
        "synopsis" : {	
          "type" : "string",	
          "example" : "Lois snoops again for Superman's secret identity.",	
          "description" : "A brief synopsis of the content. The purpose of the field is to aid in identifying the story, not to provide a plot summary to replace reading the whole thing. Does not use text from other sites or sources as it may be assumed to be under copyright."	
        },	
        "reprint-notes" : {	
          "type" : "string",	
          "example" : "The second print has a blue banner.",	
          "description" : "Reprint information (both reprint from and reprinted in)."	
        },	
        "notes" : {	
          "type" : "string",	
          "example" : "Indexed from scan.",	
          "description" : "Arbitrary notes from the indexer."	
        },	
        "keywords" : {	
          "type" : "string",	
          "example" : "Fortress of Solitude; north pole"	
        },	
        "reserved" : {	
          "type" : "integer",	
          "example" : 1,	
          "description" : "If true (1 in MySQL, as opposed to 0 for false), there is an active change being made in the data editing tables."	
        }	
      }	
    },	
    "Issue" : {	
      "description" : "Adsdf. Data table name is gcd_issue; code class is apps.gcd.models.Issue; example URL is https://www.comics.org/issue/1234/\n",	
      "required" : [ "id" ],	
      "properties" : {	
        "id" : {	
          "type" : "integer",	
          "example" : 1234,	
          "description" : "DB-generated unique, primary key."	
        }	
      }	
    }	
  }	
} 