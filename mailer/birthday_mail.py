#!/usr/bin/env python3
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
from email.mime.image import MIMEImage
import os 

def mail_birthday( configuration, user):
    dir_path = os.path.dirname(os.path.realpath(__file__))
    header = 'Hoi {},'.format(user['name'].split()[0])
    footer = 'Met vriendelijke groet,'
    # Assume birthyear 1900 was used when the age is unknown.
    if user['age'] < 100:
			#Replace string %age% with age.
      line2 = configuration['age_line'].replace('%age%',str(user['age']))
    else:
      line2 = configuration['noage_line']
    # Send an HTML email with an embedded image and a plain text message for
    # email clients that don't want to display the HTML.
    # Define these once; use them twice!
    strFrom = '%s <%s>' % (configuration['from_name'], configuration['from_address'])
    strTo   = '%s <%s>' % ( user['name'], user['email'] )

    # Create the root message and fill in the from, to, and subject headers
    msgRoot = MIMEMultipart('related')
    msgRoot['Subject'] = configuration['topic']
    msgRoot['From'] = strFrom
    msgRoot['To'] = strTo
    msgRoot.preamble = 'This is a multi-part message in MIME format.'

    # Encapsulate the plain and HTML versions of the message body in an
    # 'alternative' part, so message agents can decide which they want to display.
    msgAlternative = MIMEMultipart('alternative')
    msgRoot.attach(msgAlternative)

    msgText = MIMEText('%s\r\n\r\n%s %s \r\n\r\n%s\r\n%s' % (header, configuration['line1'], line2, footer, configuration['from_name']))
    msgAlternative.attach(msgText)

    # We reference the image in the IMG SRC attribute by the ID we give it below
    msgText = MIMEText('%s<br><br><b>%s</b> %s <br><img src="cid:image1"><br><br>%s<br>%s' % (header, configuration['line1'], line2, footer, configuration['from_name']), 'html')
    msgAlternative.attach(msgText)

    # Attach imagefile
    fp = open('%s/files/%s' % (dir_path, configuration['picture_file']), 'rb')
    msgImage = MIMEImage(fp.read())
    fp.close()
    # Define the image's ID as referenced above
    msgImage.add_header('Content-ID', '<image1>')
    msgRoot.attach(msgImage)

    toaddrs = []
    toaddrs.append(strTo)
    toaddrs.append(configuration['bcc_address'])
    # Send the email
    import smtplib
    smtp = smtplib.SMTP('localhost')
    smtp.sendmail(strFrom, toaddrs, msgRoot.as_string())
    smtp.quit()

