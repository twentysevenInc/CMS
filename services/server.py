import json, time, requests, eventlet, sys

def sendRequest(json_obj):
  if json_obj['request'] == 'SET':
    with eventlet.Timeout(1):
      try:
        r = requests.post('http://'+json_obj['serviceurl'], data='{"request":"'+json_obj['request']+'", "settings":'+json.dumps(json_obj['settings'])+'}')
      except Exception as ex:
        print '{"response":"FAILED", "name":"'+type(ex).__name__+'"}'
        sys.exit(0)
    if not r.text:
      print '{"response":"FAILED"}'
      sys.exit(0)
  else:
    with eventlet.Timeout(1):
      try:
        r = requests.post('http://'+json_obj['serviceurl'], data='{"request":"'+json_obj['request']+'"}')
      except Exception as ex:
        print '{"response":"FAILED","name":"'+type(ex).__name__+'"}'
        sys.exit(0)
    if not r.text:
      print '{"response":"FAILED"}'
      sys.exit(0)
  return r.text

eventlet.monkey_patch()
print sys.argv[1]
json_obj = json.loads(sys.argv[1])
response = sendRequest(json_obj)
print response
